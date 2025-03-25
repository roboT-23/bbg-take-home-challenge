@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Checkout</h1>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="md:flex">
                    <!-- Checkout Form Section (Left) -->
                    <div class="md:w-2/3 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Information</h2>

                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <div class="space-y-4">
                                <!-- Full Name -->
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input
                                        type="text"
                                        id="full_name"
                                        name="full_name"
                                        value="{{ old('full_name') }}"
                                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required
                                    >
                                    @error('full_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email and Phone -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        >
                                        @error('email')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input
                                            type="tel"
                                            id="phone"
                                            name="phone"
                                            value="{{ old('phone') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        >
                                        @error('phone')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address Line 1 -->
                                <div>
                                    <label for="address_line1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                                    <input
                                        type="text"
                                        id="address_line1"
                                        name="address_line1"
                                        value="{{ old('address_line1') }}"
                                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required
                                    >
                                    @error('address_line1')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address Line 2 -->
                                <div>
                                    <label for="address_line2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                                    <input
                                        type="text"
                                        id="address_line2"
                                        name="address_line2"
                                        value="{{ old('address_line2') }}"
                                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    >
                                    @error('address_line2')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- City and State/Province -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input
                                            type="text"
                                            id="city"
                                            name="city"
                                            value="{{ old('city') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        >
                                        @error('city')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="state_province" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                        <input
                                            type="text"
                                            id="state_province"
                                            name="state_province"
                                            value="{{ old('state_province') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        >
                                        @error('state_province')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Postal Code and Country -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input
                                            type="text"
                                            id="postal_code"
                                            name="postal_code"
                                            value="{{ old('postal_code') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        >
                                        @error('postal_code')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                        <input
                                            type="text"
                                            id="country"
                                            name="country"
                                            value="{{ old('country') }}"
                                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required
                                        >
                                        @error('country')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Order Notes -->
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                                    <textarea
                                        id="notes"
                                        name="notes"
                                        rows="3"
                                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    >{{ old('notes') }}</textarea>
                                    @error('notes')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md shadow-sm transition-colors">
                                    Place Order
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Order Summary Section (Right) -->
                    <div class="md:w-1/3 bg-gray-50 p-6 border-t md:border-t-0 md:border-l border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>

                        <div class="space-y-4">
                            @foreach($cartProducts as $item)
                                <div class="flex space-x-4">
                                    <div class="flex-shrink-0 w-16 h-16">
                                        <img src="https://picsum.photos/400/300" class="w-full h-full object-cover rounded-md shadow-sm">
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm font-medium text-gray-900">{{ $item['product']->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $item['product']->category->name }}</p>
                                        <div class="flex justify-between mt-1">
                                            <p class="text-xs text-gray-700">Qty: {{ $item['quantity'] }}</p>
                                            <p class="text-sm font-semibold text-gray-900">${{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">Free</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tax (10%)</span>
                                    <span class="font-medium">${{ number_format($total * 0.1, 2) }}</span>
                                </div>

                                <div class="border-t border-gray-200 my-2 pt-2">
                                    <div class="flex justify-between text-base font-semibold">
                                        <span>Total</span>
                                        <span class="text-blue-600">${{ number_format($total * 1.1, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back to Cart -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Return to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
