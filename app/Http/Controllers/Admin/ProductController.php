<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
            'category_id' => 'required|exists:product_categories,id',
            'demo_link' => 'nullable|url',
            'video_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer',
            'images.*' => 'image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image->store('product-images', 'public'),
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:product_categories,id',
            'demo_link' => 'nullable|url',
            'video_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer',
            'images.*' => 'image|max:2048',
        ]);

        $data = $request->except('thumbnail', 'images');

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($product->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image->store('product-images', 'public'),
                    'order' => $product->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->thumbnail);
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
