@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('home') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="product-detail">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-gallery">
                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                            </div>
                            @foreach($product->images as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->title }}">
                                </div>
                            @endforeach
                        </div>
                        @if($product->images->count() > 0)
                            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="product-meta">
                    <span class="category-badge">{{ $product->category->name }}</span>
                    <h1>{{ $product->title }}</h1>
                    <p class="description">{{ $product->description }}</p>

                    <div class="product-links">
                        @if($product->demo_link)
                            <a href="{{ $product->demo_link }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-box-arrow-up-right"></i> Live Demo
                            </a>
                        @endif
                        @if($product->video_link)
                            <a href="{{ $product->video_link }}" target="_blank" class="btn btn-outline-primary">
                                <i class="bi bi-play-circle"></i> Watch Video
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-dark);
    text-decoration: none;
    margin-bottom: 2rem;
    font-weight: 500;
}
.back-link:hover {
    color: var(--accent-color);
}
.product-detail {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 2rem;
}
.product-gallery {
    border-radius: 12px;
    overflow: hidden;
}
.product-gallery img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}
.category-badge {
    background: var(--accent-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1rem;
}
.product-meta h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}
.description {
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--text-dark);
    margin-bottom: 2rem;
}
.product-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}
.btn-outline-primary {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
}
.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
}
</style>
@endsection
