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
                        <a href="{{ route('admin.product-categories.index') }}" class="nav-item">
                            <i class="bi bi-folder"></i> Kategori Produk
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="nav-item active">
                            <i class="bi bi-grid-3x3"></i> Produk
                        </a>
                    </nav>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-9">
                <div class="admin-header">
                    <h2>Edit Produk</h2>
                    <p class="text-muted mb-0">Ubah detail produk: **{{ $product->title }}**</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show content-card border-0 p-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle me-2" style="font-size: 1.25rem;"></i>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="content-card">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            {{-- Field Dasar --}}
                            <h4 class="mb-3 text-primary">Detail Produk</h4>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Produk</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <hr class="my-4">

                            {{-- Field Meta/Teknis --}}
                            <h4 class="mb-3 text-primary">Spesifikasi Teknis</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Author</label>
                                    <input type="text" name="author" class="form-control" value="{{ old('author', $product->author) }}" placeholder="Nama pembuat">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Tools/Library</label>
                                    <input type="text" name="tools" class="form-control" value="{{ old('tools', $product->tools) }}" placeholder="React, Laravel, Bootstrap, dll">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Bahasa Pemrograman</label>
                                    <input type="text" name="language" class="form-control" value="{{ old('language', $product->language) }}" placeholder="JavaScript, PHP, Python, dll">
                                </div>
                            </div>
                            
                            <hr class="my-4">

                            {{-- Media Section --}}
                            <h4 class="mb-3 text-primary">Media Produk</h4>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Thumbnail Saat Ini</label>
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" class="product-thumb-preview">
                                </div>
                                <label class="form-label fw-semibold">Ubah Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                                <div class="form-text text-muted">Abaikan jika tidak ingin mengubah thumbnail.</div>
                                @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            @if($product->images->count() > 0)
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Gambar Tambahan Saat Ini</label>
                                    <div class="row g-3">
                                        @foreach($product->images as $image)
                                            <div class="col-6 col-sm-4 col-md-3">
                                                <div class="image-preview-container">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar {{ $loop->iteration }}" class="img-fluid rounded image-preview">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-text text-muted mt-2">Untuk menghapus, Anda mungkin perlu menambahkan fungsi di controller/model.</div>
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Tambah Gambar Baru (Multiple)</label>
                                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                                <div class="form-text text-muted">Bisa pilih beberapa gambar sekaligus untuk ditambahkan.</div>
                            </div>

                            <hr class="my-4">

                            {{-- Links Section --}}
                            <h4 class="mb-3 text-primary">Tautan Eksternal</h4>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Link Demo</label>
                                <input type="url" name="demo_link" class="form-control" value="{{ old('demo_link', $product->demo_link) }}" placeholder="https://example.com">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Link Video (YouTube/Lainnya)</label>
                                <input type="url" name="video_link" class="form-control" value="{{ old('video_link', $product->video_link) }}" placeholder="https://youtube.com/...">
                            </div>
                            
                            <hr class="my-4">

                            {{-- Status & Order --}}
                            <h4 class="mb-3 text-primary">Pengaturan Publikasi</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Aktif (Dipublikasikan)</option>
                                        <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Nonaktif (Draft)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Urutan</label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', $product->order) }}" placeholder="0">
                                    <div class="form-text text-muted">Angka lebih kecil akan tampil lebih dulu.</div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update Produk
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

.form-control, .form-select { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid var(--border-color); }
.form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.25rem rgba(26, 26, 46, 0.25); }
.form-label { font-weight: 600; color: var(--text-dark); }

.product-thumb-preview {
    max-width: 200px;
    height: auto;
    border-radius: 10px;
    border: 1px solid var(--border-color);
    object-fit: cover;
}

.image-preview {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border: 1px solid var(--border-color);
}

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

.alert.content-card {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
}
.alert .btn-close {
    padding: 0.5em 0.5em;
    margin: -0.375rem -0.375rem -0.375rem auto;
}
</style>
@endsection