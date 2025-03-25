{{-- resources/views/components/product-card.blade.php --}}

@props(['product'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
    <img src="https://picsum.photos/200/300" alt="{{ $product->name }}" class="w-full h-48 object-cover">
{{--    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">--}}
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
        <p class="text-gray-500 mt-1">{{ $product->category->name }}</p>
        <div class="mt-2 flex items-center justify-between">
            <span class="text-xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
            <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                View Details
            </a>
        </div>
        <div class="mt-3">
            <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" max="10" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                <button type="submit" class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700 transition-colors">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
