<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount('products')->orderBy('order')->paginate(10);
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('category-icons', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('icon');
        if ($request->hasFile('icon')) {
            if ($productCategory->icon) {
                Storage::disk('public')->delete($productCategory->icon);
            }
            $data['icon'] = $request->file('icon')->store('category-icons', 'public');
        }

        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->icon) {
            Storage::disk('public')->delete($productCategory->icon);
        }
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
