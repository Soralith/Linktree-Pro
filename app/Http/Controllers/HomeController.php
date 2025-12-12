<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['category', 'user', 'tags'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $news = $query->paginate(9);
        $categories = Category::withCount('news')->get();
        $latestNews = News::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $popularNews = News::where('is_published', true)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home', compact('news', 'categories', 'latestNews', 'popularNews', 'sliders'));
    }

    public function show($slug)
    {
        $news = News::with(['category', 'user', 'tags', 'comments'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $news->increment('views');

        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('is_published', true)
            ->take(4)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}