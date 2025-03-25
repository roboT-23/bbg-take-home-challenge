<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends AppController
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all categories for the navigation and footer
        $categories = Category::all();

        // Get featured products for the homepage (for example, the latest 8 products)
        $featuredProducts = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}
