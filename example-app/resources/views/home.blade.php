@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <!-- Hero section -->
    <div class="bg-blue-600 rounded-lg shadow-md overflow-hidden mb-8">
        <div class="px-6 py-12 max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                <span class="block">Welcome to</span>
                <span class="block text-blue-200">BBG Product Catalog</span>
            </h1>
            <p class="mt-6 max-w-xl text-xl text-blue-100">
                Discover our wide range of products across multiple categories.
            </p>
            <div class="mt-8">
                <div class="rounded-md shadow">
                    <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured categories section -->
    <div class="my-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Categories</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($categories ?? [] as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-600">Browse all {{ $category->name }} products</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Featured products section -->
    <div class="my-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts ?? [] as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                View All Products
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
@endsection
