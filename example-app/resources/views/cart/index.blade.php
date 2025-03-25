@extends('layouts.master')

@section('title', 'Shopping Cart')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Your Shopping Cart</h1>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(count($cartProducts) > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="md:flex">
                        <!-- Cart Items Section (Left) -->
                        <div class="md:w-2/3 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Items in Your Cart</h2>

                            <div class="space-y-6">
                                @foreach($cartProducts as $item)
                                    <div class="flex flex-col sm:flex-row border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 sm:w-24 sm:h-24 mb-4 sm:mb-0">
                                            <img src="https://picsum.photos/400/300" class="w-full h-full object-cover rounded-md shadow-sm">
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-grow sm:ml-6">
                                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900">{{ $item['product']->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $item['product']->category->name }}</p>
                                                    <p class="mt-1 text-md font-semibold text-blue-600">${{ number_format($item['product']->price, 2) }}</p>
                                                </div>

                                                <div class="mt-4 sm:mt-0 flex flex-col items-start sm:items-end">
                                                    <!-- Quantity Adjuster -->
                                                    <div class="inline-flex items-center border border-gray-300 rounded-md overflow-hidden">
                                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="product_id" value="{{ $item['product']->id }}">

                                                            <button type="button" class="quantity-btn minus-btn px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 focus:outline-none"
                                                                    onclick="updateQuantity(this, -1)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                </svg>
                                                            </button>

                                                            <input
                                                                type="number"
                                                                name="quantity"
                                                                value="{{ $item['quantity'] }}"
                                                                min="1"
                                                                max="10"
                                                                class="quantity-input w-12 text-center border-none focus:ring-0"
                                                                onchange="this.form.submit()"
                                                            >

                                                            <button type="button" class="quantity-btn plus-btn px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 focus:outline-none"
                                                                    onclick="updateQuantity(this, 1)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Subtotal -->
                                                    <div class="mt-2 text-sm text-gray-900">
                                                        Subtotal: <span class="font-semibold">${{ number_format($item['product']->price * $item['quantity'], 2) }}</span>
                                                    </div>

                                                    <!-- Remove Button -->
                                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="mt-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Continue Shopping
                                </a>
                            </div>
                        </div>

                        <!-- Order Summary Section (Right) -->
                        <div class="md:w-1/3 bg-gray-50 p-6 border-t md:border-t-0 md:border-l border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal ({{ count($cartProducts) }} items)</span>
                                    <span class="font-medium">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">Free</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Taxes</span>
                                    <span class="font-medium">Calculated at checkout</span>
                                </div>

                                <div class="border-t border-gray-200 my-4 pt-4">
                                    <div class="flex justify-between text-base font-semibold">
                                        <span>Total</span>
                                        <span class="text-blue-600">${{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Promo Code Section -->
                            <div class="mt-6">
                                <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-1">Promo Code</label>
                                <div class="flex">
                                    <input type="text" id="promo-code" name="promo-code" class="flex-grow rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="Enter code">
                                    <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-r-md text-sm">
                                        Apply
                                    </button>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <div class="mt-8">
                                <a href="{{ route('checkout.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md text-center transition-colors">
                                    Proceed to Checkout
                                </a>
                            </div>

                            <!-- Payment Methods -->
                            <div class="mt-6 flex justify-center space-x-4">
                                <svg class="h-6 w-auto text-gray-400" fill="currentColor" viewBox="0 0 36 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M33 4a4 4 0 0 1 4 4v12a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h29z" fill="#fff"/>
                                    <path d="M16.414 13.5V19h-2.829l-.001-7.495h2.83v1.996zM31.369 19l-.001-7.495h-2.142L26.35 15.114V11.5h-2.176l.001 7.495h2.142l2.875-3.609V19h2.176zm-7.36-5.693V19h2.177l-.001-7.495h-3.082c-.876 0-1.61.283-2.204.849-.594.566-.89 1.27-.891 2.114 0 .815.266 1.487.8 2.016.531.529 1.21.793 2.034.793.667 0 1.255-.165 1.764-.495l.228-.128-.825-1.798c-.12.095-.304.178-.518.248a2.097 2.097 0 0 1-.683.11c-.334 0-.614-.1-.837-.3a1.066 1.066 0 0 1-.335-.827c0-.35.107-.63.322-.838.215-.21.499-.315.85-.315h1.25v1.575zm-7.097-1.802h-3.293V19h3.293c.918 0 1.68-.276 2.284-.827.604-.55.906-1.215.906-1.992v-2.175c0-.762-.302-1.418-.906-1.97-.605-.55-1.366-.825-2.284-.825v-.002zm0 5.958h-1.116v-4.02h1.116c.39 0 .728.134 1.012.402.285.268.427.604.427 1.008v1.2c0 .404-.142.74-.427 1.008-.284.268-.621.402-1.012.402z" fill="#172B85"/>
                                </svg>
                                <svg class="h-6 w-auto text-gray-400" fill="currentColor" viewBox="0 0 36 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 15H8.5v-4L7 13.5 5.5 11V15H2V9h3.5l1.5 2.5L8.5 9H12v6zm8 0h-3l-1-1.5V15h-3V9h3v1.5L17 9h3l-2.5 3 2.5 3zm9.5-3c0 1.657-1.343 3-3 3h-6V9h6c1.657 0 3 1.343 3 3zm-3 1c.552 0 1-.448 1-1s-.448-1-1-1h-3v2h3z" fill-rule="nonzero" fill="#FF5F00"/>
                                </svg>
                                <svg class="h-6 w-auto text-gray-400" fill="currentColor" viewBox="0 0 36 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.42 4H8.58C6.05 4 4 6.05 4 8.58v6.84c0 2.53 2.05 4.58 4.58 4.58h18.84c2.53 0 4.58-2.05 4.58-4.58V8.58C32 6.05 29.95 4 27.42 4z" fill="#4A89DC"/>
                                    <path d="M11.32 12h1.36v4h-1.36v-4zm7 0h-1.9l-1.19 2.63L14.04 12h-1.9v4h1.36v-2.99l1.1 2.54h.97l1.1-2.52V16h1.36v-4h.29zm3.78 1.54V12h-3.4v4h3.4v-1.54h-2.04v-.77h1.55v-1.15h-1.55v-.76h2.04v.76z" fill="#fff"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg p-8 text-center max-w-md mx-auto">

                    <h2 class="mt-6 text-2xl font-semibold text-gray-900">Your cart is empty</h2>
                    <p class="mt-3 text-gray-600">Looks like you haven't added any products to your cart yet.</p>
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-sm hover:shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function updateQuantity(button, change) {
            const input = button.parentNode.querySelector('.quantity-input');
            let value = parseInt(input.value) + change;

            // Ensure value is within min and max
            value = Math.max(1, Math.min(10, value));

            // Update input value
            input.value = value;

            // Submit the form
            button.closest('form').submit();
        }
    </script>
@endsection
