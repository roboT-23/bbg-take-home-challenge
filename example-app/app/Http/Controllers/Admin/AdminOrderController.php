<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Models\Category;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends AppController
{
    /**
     * Display a listing of orders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Query builder for orders
        $ordersQuery = Order::with('items');

        // Filter by status if requested
        if ($request->has('status') && $request->status != 'all') {
            $ordersQuery->where('status', $request->status);
        }

        // Filter by search term if requested
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $ordersQuery->where(function($query) use ($searchTerm) {
                $query->where('order_number', 'like', "%{$searchTerm}%")
                    ->orWhere('full_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Sort orders
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $ordersQuery->orderBy($sortField, $sortDirection);

        // Get paginated orders
        $orders = $ordersQuery->paginate(15);

        // Get order statuses for filter
        $statuses = Order::select('status')
            ->distinct()
            ->pluck('status')
            ->toArray();

        return view('admin.orders.index', compact('categories', 'orders', 'statuses'));
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Get the order with its items
        $order = Order::with('items.product')->findOrFail($id);

        return view('admin.orders.show', compact('categories', 'order'));
    }

    /**
     * Update the order status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Generate a report of orders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Default to current month if not specified
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));

        // Get orders within date range
        $orders = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        // Calculate statistics
        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        // Orders by status
        $ordersByStatus = $orders->groupBy('status')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total' => $group->sum('total'),
                ];
            });

        // Daily sales data for chart
        $dailySales = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_sales'), DB::raw('COUNT(*) as orders_count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'total_sales' => $item->total_sales,
                    'orders_count' => $item->orders_count,
                ];
            });

        return view('admin.orders.report', compact('categories', 'orders', 'totalSales', 'totalOrders', 'averageOrderValue', 'ordersByStatus', 'dailySales', 'startDate', 'endDate'));
    }
}
