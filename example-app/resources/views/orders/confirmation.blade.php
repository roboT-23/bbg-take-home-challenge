@extends('layouts.master')

@section('title', 'Order Confirmation')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 text-center">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <div class="mb-6">
                    <div class="bg-green-100 rounded-full p-3 mx-auto w-16 h-16 flex items-center justify-center">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="mt-4 text-2xl font-bold text-gray-900">Thank You for Your Order!</h1>
                    <p class="mt-2 text-gray-600">
                        Your order has been placed successfully and is being processed.
                    </p>
                </div>

                <div class="mb-6 text-left border-t border-b border-gray-200 py-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Order Number:</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $order->order_number }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Order Date:</dt>
                            <dd class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-600">Shipping Address:</dt>
                            <dd class="text-sm text-gray-900 text-right">
                                {{ $order->full_name }}<br>
                                {{ $order->address_line1 }}<br>
                                @if($order->address_line2)
                                    {{ $order->address_line2 }}<br>
                                @endif
                                {{ $order->city }}, {{ $order->state_province }} {{ $order->postal_code }}<br>
                                {{ $order->country }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mb-6 text-left">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Details</h2>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 flex-shrink-0">
                                        <img src="https://picsum.photos/400/300" class="h-16 w-16 object-cover rounded-md">
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product_name }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($item->subtotal, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Subtotal</span>
                                <span class="text-sm font-medium">${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Shipping</span>
                                <span class="text-sm font-medium">${{ number_format($order->shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tax</span>
                                <span class="text-sm font-medium">${{ number_format($order->tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200">
                                <span class="text-base font-semibold text-gray-900">Total</span>
                                <span class="text-base font-semibold text-blue-600">${{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <a href="{{ route('products.index') }}" class="block w-full text-blue-600 hover:text-blue-800 font-medium py-3 px-4 text-center">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
