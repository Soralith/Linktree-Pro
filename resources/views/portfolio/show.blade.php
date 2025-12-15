@extends('layouts.app')

@section('title', $product->title . ' | Portfolio Detail')

@section('content')
<div class="product-detail-page bg-light-gray">
    <div class="container py-5 py-lg-6">
        
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mb-4 mb-lg-5 back-to-portfolio-btn">
            <i class="bi bi-arrow-left"></i> Kembali ke Portfolio
        </a>

        <div class="row g-5">
            
            <div class="col-lg-7">
                <div class="product-gallery-card">
                    <div class="d-lg-none mb-4">
                        <span class="badge bg-primary-soft text-primary-dark rounded-pill mb-2">
                            <i class="bi bi-folder me-1"></i> {{ $product->category->name }}
                        </span>
                        <h1 class="h2 fw-bold text-dark">{{ $product->title }}</h1>
                    </div>
                    
                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3 shadow-sm">
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="d-block w-100 product-img-main" alt="{{ $product->title }}">
                            </div>
                            
                            @foreach($product->images as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100 product-img-main" alt="{{ $product->title }} Gallery {{ $loop->index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        
                        @if($product->images->count() > 0)
                            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3 shadow-lg"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-3 shadow-lg"></span>
                            </button>
                        @endif
                        
                        <div class="product-thumbnails mt-3 d-flex gap-2 overflow-auto">
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="thumbnail-btn active">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail 1">
                            </button>
                            @foreach($product->images as $index => $image)
                                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index + 1 }}" class="thumbnail-btn">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail {{ $index + 2 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="product-detail-info-card sticky-top-spacer">
                    <div class="d-none d-lg-block">
                        <span class="badge bg-primary-soft text-primary-dark rounded-pill mb-3">
                            <i class="bi bi-folder me-1"></i> {{ $product->category->name }}
                        </span>
                        <h1 class="product-title-lg">{{ $product->title }}</h1>
                    </div>
                    
                    <h5 class="fw-bold mt-4 mb-3 text-secondary">Deskripsi Proyek</h5>
                    <p class="product-description text-gray-700 description-content">
                        {!! nl2br(e($product->description)) !!} 
                    </p>

                    <div class="product-actions mt-4 pt-3 border-top">
                        @if($product->demo_link)
                            <a href="{{ $product->demo_link }}" target="_blank" class="btn btn-primary btn-lg w-100 mb-2 shadow-primary-lg">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Kunjungi Live Demo
                            </a>
                        @endif
                        @if($product->video_link)
                            <a href="#" class="btn btn-outline-dark btn-lg w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <i class="bi bi-play-circle me-2"></i> Tonton Video Proyek
                            </a>
                        @endif
                    </div>

                    <div class="project-info mt-5 pt-4 border-top">
                        <h5 class="fw-bold mb-3 text-secondary">Detail Teknis</h5>
                        <dl class="row detail-list">
                            <dt class="col-sm-4 label">Kategori</dt>
                            <dd class="col-sm-8 value">{{ $product->category->name }}</dd>

                            <dt class="col-sm-4 label">Status</dt>
                            <dd class="col-sm-8 value">
                                <span class="badge bg-success-soft text-success-dark">Aktif</span>
                            </dd>

                            <dt class="col-sm-4 label">Pencipta</dt>
                            <dd class="col-sm-8 value">{{ $product->author }}</dd>

                            <dt class="col-sm-4 label">Tools Utama</dt>
                            <dd class="col-sm-8 value">{{ $product->tools }}</dd>

                            <dt class="col-sm-4 label">Bahasa/Stack</dt>
                            <dd class="col-sm-8 value">{{ $product->language }}</dd>

                            @if($product->images->count() > 0)
                                <dt class="col-sm-4 label">Jumlah Gambar</dt>
                                <dd class="col-sm-8 value">{{ $product->images->count() + 1 }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($product->video_link)
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="videoModalLabel">{{ $product->title }} - Video Proyek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="ratio ratio-16x9">
                    <iframe id="projectVideo" src="{{ $product->video_link }}" 
                            title="Video Proyek {{ $product->title }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('hidden.bs.modal', function (event) {
            var iframe = videoModal.querySelector('iframe');
            iframe.src = iframe.src;
        });
        
        var videoLink = "{{ $product->video_link }}";
        var embedUrl = videoLink;
        if (videoLink.includes('youtube.com/watch?v=') || videoLink.includes('youtu.be/')) {
            var videoId = '';
            if (videoLink.includes('youtube.com/watch?v=')) {
                videoId = videoLink.split('v=')[1].split('&')[0];
            } else if (videoLink.includes('youtu.be/')) {
                videoId = videoLink.split('youtu.be/')[1].split('?')[0];
            }
            if (videoId) {
                embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
            }
        }
        document.getElementById('projectVideo').src = embedUrl;
    });
</script>
@endif

<style>
:root {
    --primary-color: #1A1A2E; 
    --primary-light: #2C2C4A;
    --text-dark: #333333;
    --text-light: #6c757d;
    --border-color: #e9ecef;
    --bg-light-gray: #f8f9fa;
    --success-dark: #0f5132;
    --success-soft: #d1e7dd;
}

.bg-light-gray {
    background-color: var(--bg-light-gray) !important;
}
.text-dark { color: var(--text-dark) !important; }
.text-gray-700 { color: #495057 !important; }
.text-secondary { color: #6c757d !important; }
.text-primary-dark { color: var(--primary-color) !important; }
.bg-primary-soft { background-color: #e6e6f2 !important; }
.bg-success-soft { background-color: var(--success-soft) !important; }
.shadow-primary-lg { box-shadow: 0 10px 20px rgba(26, 26, 46, 0.2); }

.product-detail-page {
    min-height: 100vh;
    padding-bottom: 5rem;
}
.sticky-top-spacer {
    position: sticky;
    top: 100px;
}

.back-to-portfolio-btn {
    font-weight: 600;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}
.back-to-portfolio-btn:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.product-gallery-card {
    background: white;
    padding: 1.5rem;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
}
.product-img-main {
    width: 100%;
    height: 550px; 
    object-fit: cover;
    border-radius: 12px;
}
@media (max-width: 991px) {
    .product-img-main {
        height: 350px;
    }
}

.carousel-control-prev,
.carousel-control-next {
    width: 45px;
    height: 45px;
    opacity: 0.8;
    transition: opacity 0.3s;
}
.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1;
}

.product-thumbnails {
    margin-top: 1rem;
}
.thumbnail-btn {
    border: 2px solid transparent;
    padding: 0;
    background: none;
    cursor: pointer;
    flex-shrink: 0; 
    width: 80px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.2s;
    opacity: 0.6;
}
.thumbnail-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 6px;
}
.thumbnail-btn.active,
.thumbnail-btn:hover {
    border-color: var(--primary-color);
    opacity: 1;
}

.product-detail-info-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
}
.product-title-lg {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    color: var(--primary-color);
}
.product-description {
    font-size: 1rem;
    line-height: 1.7;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
}
.description-content {
}
.product-detail-info-card p {
    max-width: 100%; 
}

.btn-lg {
    padding: 0.9rem 1.5rem;
    font-weight: 600;
    border-radius: 15px; 
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s;
}
.btn-primary {
    background: var(--primary-color);
    border: none;
}
.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
}
.btn-outline-dark {
    border: 1px solid var(--border-color); 
    color: var(--text-dark);
}
.btn-outline-dark:hover {
    background: var(--bg-light-gray);
    color: var(--text-dark);
    transform: translateY(-2px);
}

.detail-list {
    margin-bottom: 0;
}
.detail-list dt {
    font-weight: 600;
    color: var(--text-light);
    padding: 0.75rem 0;
    border-bottom: 1px dashed var(--border-color);
}
.detail-list dd {
    font-weight: 700;
    color: var(--text-dark);
    padding: 0.75rem 0;
    border-bottom: 1px dashed var(--border-color);
    margin-bottom: 0;
    word-wrap: break-word; 
    overflow-wrap: break-word;
}
.detail-list dd:last-child,
.detail-list dt:last-child {
    border-bottom: none;
}
</style>
@endsection