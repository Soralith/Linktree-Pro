@extends('layouts.app')

@section('content')
<style>
/* ... (CSS yang sudah ada sebelumnya) ... */

:root {
    --primary-color: #1a202c; 
    --accent-color: #f87171; 
    --secondary-color: #e53e3e; 
    --text-color: #2d3748;
    --text-light: #a0aec0; 
    --bg-light: #f7fafc;
    --border-color: #edf2f7;
    --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 20px 25px rgba(0, 0, 0, 0.15);
}

.hero-banner-v2 {
    background: var(--primary-color);
    color: white;
    padding: 8rem 0 6rem;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.hero-title-v2 {
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 1rem;
    letter-spacing: -2px;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.hero-subtitle-v2 {
    font-size: 1.6rem;
    opacity: 0.95;
    margin-bottom: 0;
    font-weight: 300;
}

.search-form-hero-v2 {
    max-width: 800px;
    margin: 3rem auto 0;
}

.search-box-v2 {
    position: relative;
    display: flex;
    align-items: stretch;
    background: white;
    border-radius: 14px;
    padding: 0.5rem;
    box-shadow: var(--shadow-lg);
    z-index: 10;
}

.search-box-v2 i {
    position: initial;
    padding: 0 0.5rem 0 1rem;
    color: var(--text-light);
    font-size: 1.3rem;
    display: flex;
    align-items: center;
}

.search-input-v2 {
    flex: 1;
    border: none;
    padding: 0.75rem 0;
    font-size: 1.1rem;
    background: transparent;
    color: var(--text-color);
}

.search-input-v2:focus {
    outline: none;
}

.search-button-v2 {
    background: var(--accent-color);
    color: white;
    border: none;
    padding: 0.75rem 2.5rem;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: var(--shadow-sm);
    min-width: 120px;
}

.search-button-v2:hover {
    background: var(--secondary-color);
    box-shadow: 0 6px 15px rgba(248, 113, 113, 0.4);
}

.category-section-v2 {
    margin-bottom: 5rem;
    padding-top: 1rem;
}

.category-header-v2 {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 3rem;
    padding-bottom: 0.75rem;
    position: relative;
    border-bottom: 1px solid var(--border-color);
}

.category-header-v2::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 80px;
    height: 3px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

.category-icon-v2 {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

.category-title-v2 {
    font-size: 2.25rem;
    font-weight: 800;
    margin: 0;
    color: var(--text-color);
}

.category-count {
    font-size: 1rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    background-color: var(--primary-color) !important;
    color: white;
    margin-left: auto; 
}

.products-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}

.product-card-v2 {
    display: flex;
    flex-direction: column;
    background: white;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    color: var(--text-color);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
}

.product-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: var(--accent-color);
}

.product-thumbnail-v2 {
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: var(--bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-thumbnail-v2 img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card-v2:hover .product-thumbnail-v2 img {
    transform: scale(1.05);
}

.placeholder-thumbnail {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f1f1;
    color: #bdbdbd;
    font-size: 4rem;
}

.product-info-v2 {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.product-title-v2 {
    font-size: 1.35rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    line-height: 1.3;
    color: var(--text-color);
}

.product-description-v2 {
    font-size: 1rem;
    color: var(--text-light);
    margin: 0 0 1.5rem 0;
    overflow: hidden;
    position: relative;
    line-height: 1.5em;
    max-height: 4.5em; 
    flex-grow: 1;
}

.product-description-v2::after {
    content: '...';
    position: absolute;
    bottom: 0;
    right: 0;
    background: linear-gradient(to right, rgba(255, 255, 255, 0), white 50%);
    padding-left: 20px;
    pointer-events: none;
}

/* New/Modified CSS for the action buttons/links */
.product-actions-v2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem; /* Added margin for separation */
    gap: 10px; /* Space between buttons/links */
}

.read-more-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s;
    /* Removed margin-top: 0.5rem; as it's now in .product-actions-v2 */
}

.read-more-link i {
    font-size: 1.1rem;
    margin-left: 8px;
    transition: margin-left 0.3s;
}

.product-card-v2:hover .read-more-link {
    color: var(--accent-color);
}

.product-card-v2:hover .read-more-link i {
    margin-left: 12px;
}

/* Style for the Live Demo button */
.live-demo-btn-v2 {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.25rem;
    background: var(--accent-color);
    color: white;
    font-weight: 700;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s;
    font-size: 0.95rem;
    box-shadow: 0 4px 6px rgba(248, 113, 113, 0.3);
}

.live-demo-btn-v2:hover {
    background: var(--secondary-color);
    box-shadow: 0 6px 10px rgba(229, 62, 62, 0.4);
}

.live-demo-btn-v2 i {
    margin-right: 6px;
}

.empty-state-v2 {
    text-align: center;
    padding: 6rem 2rem;
    color: var(--text-light);
    background: #ffffff;
    border-radius: 16px;
    margin-top: 3rem;
    border: 2px dashed var(--border-color);
    box-shadow: var(--shadow-sm);
}

.empty-state-v2 i {
    font-size: 5rem;
    color: var(--primary-color);
    opacity: 0.5;
}

.empty-state-v2 p {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-color);
}

.empty-state-v2 .text-muted {
    color: var(--text-light) !important;
    font-size: 1.05rem;
    font-weight: 400;
}

@media (max-width: 992px) {
    .products-grid-v2 {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .hero-banner-v2 {
        padding: 6rem 0 4rem;
    }
    .hero-title-v2 {
        font-size: 3rem;
    }
    .hero-subtitle-v2 {
        font-size: 1.2rem;
    }
    .search-box-v2 {
        flex-direction: column;
        padding: 1rem;
    }
    .search-input-v2 {
        width: 100%;
        padding: 0.75rem 0.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    .search-box-v2 i {
        display: none;
    }
    .search-button-v2 {
        width: 100%;
        padding: 0.75rem 1rem;
    }
    .category-header-v2 {
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .category-title-v2 {
        font-size: 1.75rem;
    }
    .category-count {
        margin-left: 0;
    }
    .products-grid-v2 {
        grid-template-columns: 1fr;
    }
    .product-thumbnail-v2 {
        height: 200px;
    }
    /* Stack action buttons on smaller screens if necessary */
    .product-actions-v2 {
        flex-direction: column;
        align-items: stretch;
    }
    .live-demo-btn-v2, .read-more-link {
        width: 100%; /* Make them full width */
        justify-content: center; /* Center text */
    }
    .read-more-link {
        order: 2; /* Move detail link below demo button */
        padding: 0.5rem 0;
    }
    .live-demo-btn-v2 {
        order: 1; /* Keep demo button on top */
    }
}
</style>

<header class="hero-banner-v2">
    <div class="container text-center">
        <h1 class="hero-title-v2">PRODUK TEFA PPLG</h1>
        <p class="hero-subtitle-v2">- SMKN 11 Bandung -</p>
        
        <form action="{{ route('home') }}" method="GET" class="search-form-hero-v2 mt-5">
            <div class="search-box-v2">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Cari proyek, produk, atau skill..." value="{{ request('search') }}" class="search-input-v2">
                <button type="submit" class="search-button-v2">Cari</button>
            </div>
        </form>
    </div>
</header>

<main class="container py-5">
    @foreach($categories as $category)
        @if($category->products->count() > 0)
            <section class="category-section-v2" id="category-{{ $category->slug ?? $category->id }}">
                <div class="category-header-v2">
                    @if($category->icon)
                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="category-icon-v2">
                    @endif
                    <h2 class="category-title-v2">{{ $category->name }}</h2>
                    <span class="category-count badge">{{ $category->products->count() }} Proyek</span>
                </div>

                <div class="products-grid-v2">
                    @foreach($category->products as $product)
                        {{-- Mengubah <a> menjadi <div> agar bisa menampung beberapa tombol/link --}}
                        <div class="product-card-v2">
                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration: none; color: inherit; display: block; flex-grow: 1;">
                                <div class="product-thumbnail-v2">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}" loading="lazy">
                                    @else
                                        <div class="placeholder-thumbnail">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="product-info-v2">
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                    <h3 class="product-title-v2">{{ $product->title }}</h3>
                                    <p class="product-description-v2">{{ Str::limit($product->description, 70) }}</p>
                                </a>
                                
                                <div class="product-actions-v2">
                                    {{-- Tombol Live Demo --}}
                                    @if($product->demo_link)
                                        <a href="{{ $product->demo_link }}" target="_blank" class="live-demo-btn-v2">
                                            <i class="bi bi-box-arrow-up-right"></i> Live Demo
                                        </a>
                                    @endif

                                    {{-- Tautan Lihat Detail --}}
                                    <a href="{{ route('product.show', $product->slug) }}" class="read-more-link">
                                        Lihat Detail <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach

    @if($categories->sum(fn($c) => $c->products->count()) === 0)
        <div class="empty-state-v2">
            <i class="bi bi-inbox-fill"></i>
            <p class="mt-4">Saat ini belum ada proyek yang dipublikasikan dalam kategori manapun.</p>
            <p class="text-muted">Coba cari dengan kata kunci lain atau periksa kembali nanti.</p>
        </div>
    @endif
</main>
@endsection