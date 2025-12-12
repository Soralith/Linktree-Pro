@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                    Dashboard
                </a>
                <a href="{{ route('admin.news.index') }}" class="list-group-item list-group-item-action">
                    Kelola Berita
                </a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                    Kelola Kategori
                </a>
                <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action">
                    Kelola Tag
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="list-group-item list-group-item-action active">
                    Kelola Slider
                </a>
                <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action">
                    Kelola Komentar
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="mb-4">Edit Slider</h2>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Slider</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $slider->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Slider</label>
                            @if($slider->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar. Rekomendasi: 1920x500px</small>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Link (Opsional)</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                   id="link" name="link" value="{{ old('link', $slider->link) }}" placeholder="https://example.com">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Urutan</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $slider->order) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Urutan tampilan slider (semakin kecil semakin awal)</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection