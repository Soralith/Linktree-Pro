@extends('layouts.app')

@section('content')
<div class="hero-banner">
    <div class="container">
        <h1 class="hero-title">Portfolio & Projects</h1>
        <p class="hero-subtitle">Apakah akan beres sehari</p>
    </div>
</div>

<div class="container py-5">
    @foreach($categories as $category)
        @if($category->products->count() > 0)
            <div class="category-section">
                <div class="category-header">
                    @if($category->icon)
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="category-icon">
                    @endif
                    <h2>{{ $category->name }}</h2>
                </div>

                <div class="products-grid">
                    @foreach($category->products as $product)
                        <a href="{{ route('product.show', $product->slug) }}" class="product-card">
                            <div class="product-thumbnail">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--bg-light); color: var(--text-light); font-size: 3rem;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h3>{{ $product->title }}</h3>
                                <p>{{ Str::limit($product->description, 80) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    @if($categories->sum(fn($c) => $c->products->count()) === 0)
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada produk yang tersedia</p>
        </div>
    @endif
</div>

<style>
.hero-banner {
    background: linear-gradient(135deg, var(--primary-color) 0%, #2d3748 100%);
    color: white;
    padding: 4rem 0;
    text-align: center;
    margin-bottom: 3rem;
}
.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}
.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
}
.category-section {
    margin-bottom: 4rem;
}
.category-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}
.category-icon {
    width: 48px;
    height: 48px;
    object-fit: contain;
}
.category-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
}
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
}
.product-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
}
.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}
.product-thumbnail {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: var(--bg-light);
}
.product-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.product-card:hover .product-thumbnail img {
    transform: scale(1.05);
}
.product-info {
    padding: 1.5rem;
}
.product-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}
.product-info p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin: 0;
}
</style>
@endsection
