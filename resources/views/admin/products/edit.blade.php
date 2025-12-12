@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.product-categories.index') }}" class="list-group-item list-group-item-action">Kategori Produk</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action active">Produk</a>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="mb-4">Edit Produk</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thumbnail</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" style="max-width: 200px; border-radius: 8px;">
                            </div>
                            <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                            @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah thumbnail</small>
                        </div>

                        @if($product->images->count() > 0)
                            <div class="mb-3">
                                <label class="form-label">Gambar Tambahan Saat Ini</label>
                                <div class="row g-3">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar {{ $loop->iteration }}" class="img-fluid rounded">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Tambah Gambar Baru (Multiple)</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                            <small class="text-muted">Bisa pilih beberapa gambar sekaligus untuk ditambahkan</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link Demo</label>
                            <input type="url" name="demo_link" class="form-control" value="{{ old('demo_link', $product->demo_link) }}" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link Video</label>
                            <input type="url" name="video_link" class="form-control" value="{{ old('video_link', $product->video_link) }}" placeholder="https://youtube.com/...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', $product->order) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
