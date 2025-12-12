@extends('layouts.app')

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
        <div class="admin-header">
            <h2 class="admin-title">Kelola Slider</h2>
            <a href="{{ route('admin.sliders.create') }}" class="btn-submit"><i class="bi bi-plus-circle"></i> Tambah Slider</a>
        </div>
        @if(session('success'))
            <div class="alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
        @endif
        <div class="data-table-card">
            <table class="data-table">
                <thead>
                    <tr><th>No</th><th>Gambar</th><th>Judul</th><th>Link</th><th>Urutan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration + ($sliders->currentPage() - 1) * $sliders->perPage() }}</td>
                            <td><img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;"></td>
                            <td><strong>{{ $slider->title }}</strong></td>
                            <td>{{ $slider->link ? Str::limit($slider->link, 30) : '-' }}</td>
                            <td><span class="badge-count">{{ $slider->order }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn-action btn-edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center"><div class="empty-state"><i class="bi bi-images"></i><p>Belum ada slider</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $sliders->links() }}</div>
    </main>
</div>
@endsection
