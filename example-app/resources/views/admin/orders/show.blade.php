@extends('admin.layouts.admin')

@section('title', 'Order Details')
@section('header', 'Order Details')

@section('content')
    <div class="space-y-6">
        <!-- Back button and status -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
            <div>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Orders
                </a>
            </div>

            <div class="flex items-center">
                <span class="mr-3 text-sm text-gray-600">Order Status:</span>
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline-flex">
                    @csrf
                    @method('PATCH')
                    <select
                        name="status"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                    >
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button
                        type="submit"
                        class="ml-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Update
                    </button>
                </form>
            </div>
        </div>

        <!-- Order header and summary -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">
                        Order #{{ $order->order_number }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Placed on {{ $order->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>

                <div class="flex space-x-3">
                    <!-- Action buttons could go here -->
                    <a
                        href="#"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Order
                    </a>
                    <a
                        href="mailto:{{ $order->email }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email Customer
                    </a>
                </div>
            </div>

            <!-- Customer and Shipping info -->
            <div class="px-6 py-5 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-base font-medium text-gray-900 mb-3">Customer Information</h3>
                    <div class="text-sm text-gray-700">
                        <p class="font-semibold">{{ $order->full_name }}</p>
                        <p>{{ $order->email }}</p>
                        @if($order->phone)
                            <p>{{ $order->phone }}</p>
                        @endif
                    </div>

                    @if($order->notes)
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-1">Order Notes</h4>
                            <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>

                <div>
                    <h3 class="text-base font-medium text-gray-900 mb-3">Shipping Address</h3>
                    <div class="text-sm text-gray-700">
                        <p>{{ $order->full_name }}</p>
                        <p>{{ $order->address_line1 }}</p>
                        @if($order->address_line2)
                            <p>{{ $order->address_line2 }}</p>
                        @endif
                        <p>{{ $order->city }}, {{ $order->state_province }} {{ $order->postal_code }}</p>
                        <p>{{ $order->country }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-base font-medium text-gray-900">Order Items</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subtotal
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 flex-shrink-0">
                                        <img src="https://picsum.photos/400/300" class="h-16 w-16 object-cover rounded-md">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->product_name }}
                                        </div>
                                        @if($item->product)
                                            <div class="text-sm text-gray-500">
                                                {{ $item->product->category->name }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ number_format($item->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($item->subtotal, 2) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-base font-medium text-gray-900">Order Summary</h3>
            </div>
            <div class="px-6 py-5">
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-600">Subtotal</dt>
                        <dd class="text-sm text-gray-900">${{ number_format($order->subtotal, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-600">Shipping</dt>
                        <dd class="text-sm text-gray-900">${{ number_format($order->shipping, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-600">Tax</dt>
                        <dd class="text-sm text-gray-900">${{ number_format($order->tax, 2) }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-3">
                        <dt class="text-base font-medium text-gray-900">Total</dt>
                        <dd class="text-base font-medium text-blue-600">${{ number_format($order->total, 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
