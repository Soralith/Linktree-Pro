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
            <div class="d-flex justify-content-between mb-4">
                <h2>Produk</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $product->thumbnail) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;"></td>
                                    <td>{{ Str::limit($product->title, 40) }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td><span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($product->status) }}</span></td>
                                    <td>
                                        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-info" target="_blank">Lihat</a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Belum ada produk</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
