<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Models\Category;
use App\Models\Order\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends AppController
{
    /**
     * Admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(): \Illuminate\View\View
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Count statistics for dashboard
        $stats = [
            'orders_count' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'total_sales' => Order::sum('total'),
        ];

        // Get recent orders
        $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('categories', 'stats', 'recentOrders'));
    }
}
