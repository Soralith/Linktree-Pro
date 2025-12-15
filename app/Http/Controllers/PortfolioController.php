<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class PortfolioController extends Controller
{
    public function index()
    {
        $search = request('search');
        
        $categories = ProductCategory::with(['products' => function($q) use ($search) {
            $q->where('status', 'active');
            if ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");
                });
            }
            $q->orderBy('order')->orderBy('created_at', 'desc');
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
