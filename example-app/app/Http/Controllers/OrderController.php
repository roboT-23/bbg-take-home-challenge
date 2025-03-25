<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends AppController
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Get all orders (in a real app, you'd filter by user)
        $orders = Order::latest()->paginate(10);

        return view('orders.index', compact('categories', 'orders'));
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

        return view('orders.show', compact('categories', 'order'));
    }

    /**
     * Display the order confirmation page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function confirmation($id)
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Get the order with its items
        $order = Order::with('items.product')->findOrFail($id);

        return view('orders.confirmation', compact('categories', 'order'));
    }
}
