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
                        <a href="{{ route('admin.dashboard') }}" class="nav-item">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-item">
                            <i class="bi bi-folder"></i> Kategori Produk
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="nav-item active">
                            <i class="bi bi-grid-3x3"></i> Produk
                        </a>
                    </nav>
                </div>
            </div>

            <div class="col-md-9">
                <div class="admin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2>Produk</h2>
                            <p class="text-muted mb-0">Kelola semua produk portfolio Anda</p>
                        </div>
                        <a href="{{ route('admin.products.create') }}" class="btn-custom btn-primary">
                            <i class="bi bi-plus-lg"></i> Tambah Produk
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 border-0">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="content-card">
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="product-thumb">
                                                <div>
                                                    <div class="fw-semibold">{{ Str::limit($product->title, 40) }}</div>
                                                    <div class="text-muted small">{{ Str::limit($product->description, 60) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="category-tag">{{ $product->category->name }}</span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $product->status }}">{{ ucfirst($product->status) }}</span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('product.show', $product->slug) }}" class="btn-action btn-info" target="_blank" title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product) }}" class="btn-action btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-light);"></i>
                                            <p class="text-muted mt-2">Belum ada produk</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
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
.btn-custom {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-primary {
    background: var(--primary-color);
    color: white;
}
.btn-primary:hover {
    background: #252541;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26,26,46,0.2);
}
.content-card {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border-color);
    overflow: hidden;
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
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 12px;
    border: 2px solid var(--border-color);
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
.action-buttons {
    display: flex;
    gap: 0.5rem;
}
.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}
.btn-action.btn-info {
    background: rgba(59,130,246,0.15);
    color: #3b82f6;
}
.btn-action.btn-warning {
    background: rgba(245,158,11,0.15);
    color: #f59e0b;
}
.btn-action.btn-danger {
    background: rgba(239,68,68,0.15);
    color: #ef4444;
}
.btn-action:hover {
    transform: translateY(-2px);
    opacity: 0.8;
}
</style>
@endsection
