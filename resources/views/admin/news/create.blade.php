@extends('layouts.app')

@section('content')
<div class="admin-layout">
    <aside class="admin-sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i> Dashboard
            </a></li>
            <li><a href="{{ route('admin.news.index') }}" class="active">
                <i class="bi bi-newspaper"></i> Kelola Berita
            </a></li>
            <li><a href="{{ route('admin.categories.index') }}">
                <i class="bi bi-folder"></i> Kelola Kategori
            </a></li>
            <li><a href="{{ route('admin.tags.index') }}">
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
            <h2 class="admin-title">Tambah Berita</h2>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Berita</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" placeholder="Masukkan judul berita" required>
                    @error('title')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tag</label>
                        <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tags')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                        <small class="form-help">Tekan Ctrl untuk memilih beberapa tag.</small>
                    </div>
                </div>

                <div class="form-group">
                    <label>Gambar Thumbnail</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                    <small class="form-help">Format: JPG, PNG, GIF (Maks 2MB)</small>
                </div>

                <div class="form-group">
                    <label>Konten Berita</label>
                    <textarea name="content" rows="12" class="form-control @error('content') is-invalid @enderror"
                              placeholder="Tulis konten berita..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle"></i> Simpan & Terbitkan
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
