<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category', 'user', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['is_published'] = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news-images', 'public');
        }

        $news = News::create($data);

        if ($request->has('tags')) {
            $news->tags()->sync($request->tags);
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->except(['tags', 'image']);
        $data['is_published'] = true;

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news-images', 'public');
        }

        $news->update($data);

        if ($request->has('tags')) {
            $news->tags()->sync($request->tags);
        }

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}