<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends AppController
{
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get categories for the navigation
        $categories = Category::all();

        // Get cart items
        $cartItems = session()->get('cart', []);
        $cartProducts = [];
        $total = 0;

        // Get product details for items in the cart
        if (!empty($cartItems)) {
            foreach ($cartItems as $id => $details) {
                $product = Product::find($id);
                if ($product) {
                    $cartProducts[] = [
                        'product' => $product,
                        'quantity' => $details['quantity']
                    ];
                    $total += $product->price * $details['quantity'];
                }
            }
        }

        // If cart is empty, redirect back to cart
        if (empty($cartProducts)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add some products before checkout.');
        }

        return view('checkout.index', compact('categories', 'cartProducts', 'total'));
    }

    /**
     * Process the checkout and create an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request)
    {
        // Validate checkout form
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state_province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Get cart items
        $cartItems = session()->get('cart', []);
        $cartProducts = [];
        $subtotal = 0;

        // Calculate cart total
        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartProducts[] = [
                    'product' => $product,
                    'quantity' => $details['quantity']
                ];
                $subtotal += $product->price * $details['quantity'];
            }
        }

        // If cart is empty, redirect back to cart
        if (empty($cartProducts)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add some products before checkout.');
        }

        // Calculate order totals
        $tax = $subtotal * 0.1; // Example: 10% tax
        $shipping = 0; // Free shipping
        $total = $subtotal + $tax + $shipping;

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address_line1' => $validated['address_line1'],
                'address_line2' => $validated['address_line2'] ?? null,
                'city' => $validated['city'],
                'state_province' => $validated['state_province'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items
            foreach ($cartProducts as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['product']->price * $item['quantity'],
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Clear the cart
            session()->forget('cart');

            // Redirect to order confirmation
            return redirect()->route('orders.confirmation', $order->id)->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $e) {
            // Roll back the transaction
            DB::rollback();

            // Redirect back with error
            return back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }
}
