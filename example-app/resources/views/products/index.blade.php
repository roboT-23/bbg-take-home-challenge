@extends('layouts.master')

@section('title', 'Products')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            @if(isset($currentCategory))
                {{ $currentCategory->name }} Products
            @else
                All Products
            @endif
        </h1>

        <!-- Category Filter -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <form method="GET" action="{{ route('products.index') }}" class="md:flex items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-grow">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Filter by Category</label>
                    <select
                        name="category"
                        id="category"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ (isset($currentCategory) && $currentCategory->id == $category->id) ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                        Apply Filter
                    </button>

                    @if(request()->has('category'))
                        <a href="{{ route('products.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">
                            Clear Filters
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-gray-500">Try changing your filters or check back later for new products.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
@endsection
