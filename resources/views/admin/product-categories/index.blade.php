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
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-item active">
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2>Kategori Produk</h2>
                            <p class="text-muted mb-0">Kelola kategori untuk produk Anda</p>
                        </div>
                        <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Kategori
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="content-card">
                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Nama</th>
                                    <th>Jumlah Produk</th>
                                    <th>Urutan</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            @if($category->icon)
                                                <img src="{{ asset('storage/' . $category->icon) }}" class="category-icon-thumb">
                                            @else
                                                <div class="icon-placeholder">
                                                    <i class="bi bi-folder"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td><span class="fw-semibold">{{ $category->name }}</span></td>
                                        <td><span class="category-tag">{{ $category->products_count }} produk</span></td>
                                        <td><span class="text-muted">{{ $category->order }}</span></td>
                                        <td class="text-end">
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn-action btn-action-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-action-danger" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-light);"></i>
                                            <p class="text-muted mt-2">Belum ada kategori</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-panel { background: var(--bg-light); min-height: 100vh; }
.admin-sidebar { background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; position: sticky; top: 100px; }
.sidebar-header { padding: 1.5rem; background: var(--primary-color); color: white; }
.sidebar-header h5 { margin: 0; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
.sidebar-nav { padding: 1rem 0; }
.nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.9rem 1.5rem; color: var(--text-dark); text-decoration: none; transition: all 0.2s; font-weight: 500; }
.nav-item:hover { background: var(--bg-light); color: var(--primary-color); }
.nav-item.active { background: linear-gradient(90deg, rgba(26,26,46,0.1) 0%, transparent 100%); color: var(--primary-color); border-left: 3px solid var(--primary-color); }
.admin-header { margin-bottom: 2rem; }
.admin-header h2 { font-size: 2rem; font-weight: 700; margin-bottom: 0.25rem; }
.content-card { background: white; border-radius: 16px; border: 1px solid var(--border-color); overflow: hidden; }
.modern-table { width: 100%; border-collapse: collapse; }
.modern-table thead th { padding: 1rem 1.5rem; text-align: left; font-weight: 600; color: var(--text-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; background: var(--bg-light); }
.modern-table tbody td { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-color); }
.modern-table tbody tr:last-child td { border-bottom: none; }
.modern-table tbody tr:hover { background: var(--bg-light); }
.category-icon-thumb { width: 40px; height: 40px; object-fit: contain; border-radius: 8px; }
.icon-placeholder { width: 40px; height: 40px; background: var(--bg-light); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-light); }
.category-tag { background: var(--bg-light); padding: 0.4rem 0.9rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; color: var(--text-dark); }
.action-buttons { display: flex; gap: 0.5rem; justify-content: flex-end; }
.btn-action { border: none; background: none; padding: 0.5rem 0.75rem; border-radius: 8px; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
.btn-action-warning { color: #f59e0b; background: rgba(245,158,11,0.1); }
.btn-action-warning:hover { background: rgba(245,158,11,0.2); }
.btn-action-danger { color: #ef4444; background: rgba(239,68,68,0.1); }
.btn-action-danger:hover { background: rgba(239,68,68,0.2); }
.btn-primary { background: var(--primary-color); border: none; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; }
.btn-primary:hover { background: #252541; }
</style>
@endsection
