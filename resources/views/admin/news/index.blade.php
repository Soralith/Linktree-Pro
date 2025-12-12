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
            <h2 class="admin-title">Kelola Berita</h2>
            <a href="{{ route('admin.news.create') }}" class="btn-submit">
                <i class="bi bi-plus-circle"></i> Tambah Berita
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="data-table-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Views</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($news->currentPage() - 1) * $news->perPage() }}</td>
                                <td><strong>{{ Str::limit($item->title, 50) }}</strong></td>
                                <td><span class="badge-category">{{ $item->category->name }}</span></td>
                                <td>{{ $item->user->name }}</td>
                                <td><span class="badge-views">{{ $item->views }}</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('news.show', $item->slug) }}" class="btn-action btn-view" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn-action btn-edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="empty-state">
                                        <i class="bi bi-newspaper"></i>
                                        <p>Belum ada berita</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-wrapper">
            {{ $news->links() }}
        </div>
    </main>
</div>
@endsection
