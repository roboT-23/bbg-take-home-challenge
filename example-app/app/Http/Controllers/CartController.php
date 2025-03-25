<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends AppController
{
    /**
     * Display the cart contents.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all categories for the navigation
        $categories = Category::all();

        // For this example, we'll use a session-based cart
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

        return view('cart.index', compact('categories', 'cartProducts', 'total'));
    }

    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        // Get current cart
        $cart = session()->get('cart', []);

        // If item already in cart, update quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add new item to cart
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }

        // Update session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Remove a product from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    /**
     * Update product quantity in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }
}
