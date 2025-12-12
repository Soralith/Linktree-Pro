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
            <div class="d-flex justify-content-between mb-4">
                <h2>Kategori Produk</h2>
                <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Icon</th>
                                <th>Nama</th>
                                <th>Jumlah Produk</th>
                                <th>Urutan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}" style="width: 40px; height: 40px; object-fit: contain;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products_count }}</td>
                                    <td>{{ $category->order }}</td>
                                    <td>
                                        <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
