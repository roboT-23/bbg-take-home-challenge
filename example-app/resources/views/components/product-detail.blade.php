{{-- resources/views/components/product-detail.blade.php --}}

@props(['product', 'relatedProducts' => null])

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="md:flex">
        <!-- Product Image -->
        <div class="md:w-1/2">
{{--            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">--}}
            <img src="https://picsum.photos/650/400" alt="{{ $product->name }}" class="w-full h-96 object-cover">
        </div>

        <!-- Product Info -->
        <div class="p-6 md:w-1/2">
            <!-- Back button -->
            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Listing
                </a>
            </div>

            <!-- Product details -->
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

            <div class="flex items-center mb-4">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ $product->category->name }}
                </span>
            </div>

            <div class="text-2xl font-bold text-blue-600 mb-4">
                ${{ number_format($product->price, 2) }}
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Description</h2>
                <p class="text-gray-700">{{ $product->description }}</p>
            </div>

            <!-- Add to cart form -->
            <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="1"
                            min="1"
                            max="10"
                            class="border border-gray-300 rounded w-20 px-3 py-2"
                        >
                    </div>
                    <div class="flex-grow">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors"
                        >
                            Add to Cart
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Products Section -->
    @if($relatedProducts && $relatedProducts->count() > 0)
        <div class="p-6 border-t border-gray-200">
            <h2 class="text-xl font-bold mb-4">Related Products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </div>
    @endif
</div>
