@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="{{ route('admin.product-categories.index') }}" class="list-group-item list-group-item-action">Kategori Produk</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Produk</a>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="mb-4">Dashboard Admin</h2>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Produk</h5>
                            <h2 class="display-4">{{ \App\Models\Product::count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Kategori</h5>
                            <h2 class="display-4">{{ \App\Models\ProductCategory::count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Produk Aktif</h5>
                            <h2 class="display-4">{{ \App\Models\Product::where('status', 'active')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Produk Terbaru</h5>
                </div>
                <div class="list-group list-group-flush">
                    @foreach(\App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $product->title }}</h6>
                                    <small class="text-muted">{{ $product->category->name }} - {{ $product->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($product->status) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
