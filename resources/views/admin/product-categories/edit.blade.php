@extends('layouts.app')

@section('content')
<div class="admin-panel">
    <div class="container-fluid py-4">
        <div class="row g-4">
            {{-- Sidebar --}}
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

            {{-- Main Content --}}
            <div class="col-md-9">
                <div class="admin-header">
                    <h2>Edit Kategori</h2>
                    <p class="text-muted mb-0">Ubah detail untuk kategori produk: **{{ $productCategory->name }}**</p>
                </div>

                <div class="content-card">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.product-categories.update', $productCategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Kategori</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $productCategory->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Icon</label>
                                @if($productCategory->icon)
                                    <div class="mb-3 d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $productCategory->icon) }}" class="category-icon-thumb" style="width: 80px; height: 80px;">
                                        <small class="text-muted">Icon saat ini</small>
                                    </div>
                                @endif
                                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                                <div class="form-text text-muted">Abaikan jika tidak ingin mengubah icon.</div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Urutan</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', $productCategory->order) }}">
                                <div class="form-text text-muted">Tentukan urutan tampilan kategori.</div>
                            </div>
                            
                            <hr class="my-4">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update Kategori
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #1A1A2E;
    --bg-light: #f4f7f6;
    --border-color: #e0e0e0;
    --text-dark: #333;
    --text-light: #6c757d;
}

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

.form-control { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid var(--border-color); }
.form-control:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.25rem rgba(26, 26, 46, 0.25); }
.form-label { font-weight: 600; color: var(--text-dark); }

.category-icon-thumb { width: 40px; height: 40px; object-fit: contain; border-radius: 8px; border: 1px solid var(--border-color); }
.btn-primary { 
    background: var(--primary-color); 
    border: none; 
    padding: 0.75rem 1.5rem; 
    border-radius: 10px; 
    font-weight: 600; 
    display: inline-flex; 
    align-items: center; 
    gap: 0.5rem; 
    transition: background 0.2s;
}
.btn-primary:hover { background: #252541; }

.btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s;
}
</style>
@endsection