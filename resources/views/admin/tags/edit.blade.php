@extends('layouts.app')

@section('content')
<div class="admin-layout">
    <aside class="admin-sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i> Dashboard
            </a></li>
            <li><a href="{{ route('admin.news.index') }}">
                <i class="bi bi-newspaper"></i> Kelola Berita
            </a></li>
            <li><a href="{{ route('admin.categories.index') }}">
                <i class="bi bi-folder"></i> Kelola Kategori
            </a></li>
            <li><a href="{{ route('admin.tags.index') }}" class="active">
                <i class="bi bi-tags"></i> Kelola Tag
            </a></li>
            <li><a href="{{ route('admin.sliders.index') }}">
                <i class="bi bi-images"></i> Kelola Slider
            </a></li>
            <li><a href="{{ route('admin.comments.index') }}">
                <i class="bi bi-chat-dots"></i> Kelola Komentar
            </a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <div class="admin-header">
            <h2 class="admin-title">Edit Tag</h2>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Tag</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $tag->name) }}" required>
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                    <small class="form-help">Slug akan diperbarui otomatis dari nama tag.</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                    <a href="{{ route('admin.tags.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
