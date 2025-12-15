@extends('layouts.app')

@section('content')
<div class="admin-panel">
    <div class="container-fluid py-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="admin-sidebar">
                    <div class="sidebar-header">
                        <h5><i class="bi bi-grid"></i> Admin Panel</h5>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-item">
                            <i class="bi bi-folder"></i> Kategori Produk
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="nav-item">
                            <i class="bi bi-grid-3x3"></i> Produk
                        </a>
                    </nav>
                </div>
            </div>

            <div class="col-md-9">
                <div class="admin-header">
                    <h2>Dashboard Overview</h2>
                    <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card stat-primary">
                            <div class="stat-icon">
                                <i class="bi bi-grid-3x3"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ \App\Models\Product::count() }}</h3>
                                <p>Total Products</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-success">
                            <div class="stat-icon">
                                <i class="bi bi-folder"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ \App\Models\ProductCategory::count() }}</h3>
                                <p>Categories</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-info">
                            <div class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ \App\Models\Product::where('status', 'active')->count() }}</h3>
                                <p>Active Products</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-header-custom">
                        <h5><i class="bi bi-clock-history"></i> Recent Products</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Product::with('category')->latest()->take(5)->get() as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="product-thumb">
                                                <span class="fw-semibold">{{ Str::limit($product->title, 30) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="category-tag">{{ $product->category->name }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $product->status }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td class="text-muted">{{ $product->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-panel {
    background: var(--bg-light);
    min-height: 100vh;
}
.admin-sidebar {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border-color);
    overflow: hidden;
    position: sticky;
    top: 100px;
}
.sidebar-header {
    padding: 1.5rem;
    background: var(--primary-color);
    color: white;
}
.sidebar-header h5 {
    margin: 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.sidebar-nav {
    padding: 1rem 0;
}
.nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.9rem 1.5rem;
    color: var(--text-dark);
    text-decoration: none;
    transition: all 0.2s;
    font-weight: 500;
}
.nav-item:hover {
    background: var(--bg-light);
    color: var(--primary-color);
}
.nav-item.active {
    background: linear-gradient(90deg, rgba(26,26,46,0.1) 0%, transparent 100%);
    color: var(--primary-color);
    border-left: 3px solid var(--primary-color);
}
.admin-header {
    margin-bottom: 2rem;
}
.admin-header h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.75rem;
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s;
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
.stat-icon {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
}
.stat-primary .stat-icon {
    background: rgba(26,26,46,0.1);
    color: var(--primary-color);
}
.stat-success .stat-icon {
    background: rgba(34,197,94,0.1);
    color: #22c55e;
}
.stat-info .stat-icon {
    background: rgba(59,130,246,0.1);
    color: #3b82f6;
}
.stat-content h3 {
    font-size: 2rem;
    font-weight: 800;
    margin: 0;
}
.stat-content p {
    margin: 0;
    color: var(--text-light);
    font-size: 0.95rem;
}
.content-card {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border-color);
    overflow: hidden;
}
.card-header-custom {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
}
.card-header-custom h5 {
    margin: 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.modern-table {
    width: 100%;
    border-collapse: collapse;
}
.modern-table thead th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: var(--bg-light);
}
.modern-table tbody td {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
}
.modern-table tbody tr:last-child td {
    border-bottom: none;
}
.modern-table tbody tr:hover {
    background: var(--bg-light);
}
.product-thumb {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 10px;
}
.category-tag {
    background: var(--bg-light);
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-dark);
}
.status-badge {
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
}
.status-active {
    background: rgba(34,197,94,0.15);
    color: #16a34a;
}
.status-inactive {
    background: rgba(148,163,184,0.15);
    color: #64748b;
}
</style>
@endsection
