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
                        <a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</a>
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-item active"><i class="bi bi-folder"></i> Kategori Produk</a>
                        <a href="{{ route('admin.products.index') }}" class="nav-item"><i class="bi bi-grid-3x3"></i> Produk</a>
                    </nav>
                </div>
            </div>

            <div class="col-md-9">
                <div class="admin-header">
                    <h2>Tambah Kategori</h2>
                    <p class="text-muted">Buat kategori baru untuk produk Anda</p>
                </div>

                <div class="content-card">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.product-categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nama Kategori</label>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Web Development" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Icon</label>
                                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Ukuran rekomendasi: 64x64px</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Urutan</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" placeholder="0">
                                <small class="text-muted">Angka lebih kecil akan tampil lebih awal</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan</button>
                                <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-panel{background:var(--bg-light);min-height:100vh}
.admin-sidebar{background:white;border-radius:16px;border:1px solid var(--border-color);overflow:hidden;position:sticky;top:100px}
.sidebar-header{padding:1.5rem;background:var(--primary-color);color:white}
.sidebar-header h5{margin:0;font-weight:700;display:flex;align-items:center;gap:.5rem}
.sidebar-nav{padding:1rem 0}
.nav-item{display:flex;align-items:center;gap:.75rem;padding:.9rem 1.5rem;color:var(--text-dark);text-decoration:none;transition:all .2s;font-weight:500}
.nav-item:hover{background:var(--bg-light);color:var(--primary-color)}
.nav-item.active{background:linear-gradient(90deg,rgba(26,26,46,.1) 0%,transparent 100%);color:var(--primary-color);border-left:3px solid var(--primary-color)}
.admin-header{margin-bottom:2rem}
.admin-header h2{font-size:2rem;font-weight:700;margin-bottom:.25rem}
.content-card{background:white;border-radius:16px;border:1px solid var(--border-color);overflow:hidden}
.form-control-lg{padding:.875rem 1.25rem;font-size:1.05rem}
.btn-primary{background:var(--primary-color);border:none;padding:.75rem 1.5rem;border-radius:10px;font-weight:600;display:inline-flex;align-items:center;gap:.5rem}
.btn-primary:hover{background:#252541}
.btn-secondary{background:var(--bg-light);color:var(--text-dark);border:none;padding:.75rem 1.5rem;border-radius:10px;font-weight:600}
.btn-secondary:hover{background:#e2e8f0}
</style>
@endsection
