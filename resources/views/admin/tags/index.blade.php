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
            <h2 class="admin-title">Kelola Tag</h2>
            <a href="{{ route('admin.tags.create') }}" class="btn-submit">
                <i class="bi bi-plus-circle"></i> Tambah Tag
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="data-table-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tag</th>
                        <th>Slug</th>
                        <th>Jumlah Berita</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td>{{ $loop->iteration + ($tags->currentPage() - 1) * $tags->perPage() }}</td>
                            <td><strong>{{ $tag->name }}</strong></td>
                            <td><code>{{ $tag->slug }}</code></td>
                            <td><span class="badge-count">{{ $tag->news_count }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn-action btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline">
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
                            <td colspan="5" class="text-center">
                                <div class="empty-state">
                                    <i class="bi bi-tags"></i>
                                    <p>Belum ada tag</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $tags->links() }}
        </div>
    </main>
</div>
@endsection
