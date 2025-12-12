@extends('layouts.app')

@push('styles')
<style>
.admin-layout { display: flex; min-height: calc(100vh - 200px); background: #f8f9fa; }
.admin-sidebar { width: 280px; background: white; padding: 2rem 0; border-right: 1px solid #e9ecef; }
.sidebar-menu { list-style: none; padding: 0; margin: 0; }
.sidebar-menu li a { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 2rem; color: #2d3436; text-decoration: none; transition: all 0.2s; font-weight: 500; }
.sidebar-menu li a:hover { background: #f8f9fa; color: #1a1a2e; }
.sidebar-menu li a.active { background: #1a1a2e; color: white; border-right: 4px solid #e94560; }
.admin-content { flex: 1; padding: 2rem; }
.form-card { background: white; border-radius: 16px; border: 1px solid #e9ecef; padding: 2rem; max-width: 900px; }
</style>
@endpush

@section('content')
<div class="admin-layout">
    <aside class="admin-sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.news.index') }}"><i class="bi bi-newspaper"></i> Kelola Berita</a></li>
            <li><a href="{{ route('admin.categories.index') }}"><i class="bi bi-folder"></i> Kelola Kategori</a></li>
            <li><a href="{{ route('admin.tags.index') }}"><i class="bi bi-tags"></i> Kelola Tag</a></li>
            <li><a href="{{ route('admin.sliders.index') }}" class="active"><i class="bi bi-images"></i> Kelola Slider</a></li>
            <li><a href="{{ route('admin.comments.index') }}"><i class="bi bi-chat-dots"></i> Kelola Komentar</a></li>
        </ul>
    </aside>
    <main class="admin-content">
        <div class="admin-header"><h2 class="admin-title">Tambah Slider</h2></div>
        <div class="form-card">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Slider</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<span class="error-text">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Gambar Slider</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                    @error('image')<span class="error-text">{{ $message }}</span>@enderror
                    <small class="form-help">Rekomendasi ukuran: 1920x500px</small>
                </div>
                <div class="form-group">
                    <label>Link (Opsional)</label>
                    <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="https://example.com">
                    @error('link')<span class="error-text">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}">
                    @error('order')<span class="error-text">{{ $message }}</span>@enderror
                    <small class="form-help">Urutan tampilan slider (semakin kecil semakin awal)</small>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit"><i class="bi bi-check-circle"></i> Simpan</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn-cancel"><i class="bi bi-x-circle"></i> Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
