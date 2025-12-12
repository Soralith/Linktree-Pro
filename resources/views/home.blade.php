@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        @if($sliders->count() > 0)
            <div id="newsSlider" class="carousel slide hero-carousel" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($sliders as $index => $slider)
                        <button type="button" data-bs-target="#newsSlider" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index === 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($sliders as $index => $slider)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            @if($slider->link)
                                <a href="{{ $slider->link }}">
                                    <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                            @endif
                            <div class="carousel-caption">
                                <h3>{{ $slider->title }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#newsSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        @endif
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-9">
            <div class="section-header">
                <h2 class="section-title">Berita Terkini</h2>
                <form action="{{ route('home') }}" method="GET" class="search-form">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>

            @if($news->count() > 0)
                <div class="news-grid">
                    @foreach($news as $item)
                        <article class="news-card">
                            <a href="{{ route('news.show', $item->slug) }}" class="news-card-link">
                                <div class="news-card-image">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    @else
                                        <div class="news-card-placeholder">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                    @endif
                                    <span class="news-card-category">{{ $item->category->name }}</span>
                                </div>
                                <div class="news-card-content">
                                    <h3 class="news-card-title">{{ $item->title }}</h3>
                                    <p class="news-card-excerpt">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                                    <div class="news-card-meta">
                                        <span><i class="bi bi-person"></i> {{ $item->user->name }}</span>
                                        <span><i class="bi bi-clock"></i> {{ $item->created_at->diffForHumans() }}</span>
                                        <span><i class="bi bi-eye"></i> {{ $item->views }}</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $news->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada berita yang ditemukan</p>
                </div>
            @endif
        </div>

        <aside class="col-lg-3">
            <div class="sidebar-widget">
                <h4 class="widget-title">Kategori</h4>
                <div class="category-list">
                    @foreach($categories as $category)
                        <a href="{{ route('home', ['category' => $category->slug]) }}" class="category-item">
                            <span>{{ $category->name }}</span>
                            <span class="category-count">{{ $category->news_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-widget">
                <h4 class="widget-title">Berita Populer</h4>
                <div class="popular-list">
                    @foreach($popularNews as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="popular-item">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                            @else
                                <div class="popular-placeholder">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                            @endif
                            <div class="popular-content">
                                <h5>{{ Str::limit($item->title, 60) }}</h5>
                                <span class="popular-views"><i class="bi bi-eye"></i> {{ $item->views }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
