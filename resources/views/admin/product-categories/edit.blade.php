@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.product-categories.index') }}" class="list-group-item list-group-item-action active">Kategori Produk</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Produk</a>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="mb-4">Edit Kategori</h2>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.product-categories.update', $productCategory) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $productCategory->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            @if($productCategory->icon)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $productCategory->icon) }}" style="width: 80px; height: 80px; object-fit: contain;">
                                </div>
                            @endif
                            <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', $productCategory->order) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
