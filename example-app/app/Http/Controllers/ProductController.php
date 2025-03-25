<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AppController
{
    /**
     * Display a listing of products with optional category filtering.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get all categories for the navigation
        $categories = Category::all();

        // Query builder for products
        $productsQuery = Product::with('category');

        // Filter by category if requested
        if ($request->has('category')) {
            $productsQuery->where('category_id', $request->category);
            $currentCategory = Category::find($request->category);
        } else {
            $currentCategory = null;
        }

        // Get paginated products
        $products = $productsQuery->paginate(10);

        return view('products.index', compact('products', 'categories', 'currentCategory'));
    }

    /**
     * Display the details for a specific product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Get all categories for the navigation
        $categories = Category::all();

        // Get the product with its category
        $product = Product::with('category')->findOrFail($id);

        // Get related products from the same category (optional)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'categories', 'relatedProducts'));
    }

    /**
     * API endpoint to list products with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex(Request $request)
    {
        $query = Product::with('category');

        // Filter by category if requested
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Pagination with 10 items per page as required
        $products = $query->paginate(10);

        return response()->json($products);
    }

    /**
     * API endpoint to get a single product by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiShow($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product);
    }

    /**
     * API endpoint to list all product categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
}
