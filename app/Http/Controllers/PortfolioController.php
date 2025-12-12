<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with(['products' => function($q) {
            $q->where('status', 'active')->orderBy('order')->orderBy('created_at', 'desc');
        }])->orderBy('order')->get();

        return view('portfolio.index', compact('categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('portfolio.show', compact('product'));
    }
}
