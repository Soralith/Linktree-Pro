@extends('layouts.app')

@section('content')
<div class="admin-layout">
    <aside class="admin-sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.news.index') }}"><i class="bi bi-newspaper"></i> Kelola Berita</a></li>
            <li><a href="{{ route('admin.categories.index') }}"><i class="bi bi-folder"></i> Kelola Kategori</a></li>
            <li><a href="{{ route('admin.tags.index') }}"><i class="bi bi-tags"></i> Kelola Tag</a></li>
            <li><a href="{{ route('admin.sliders.index') }}"><i class="bi bi-images"></i> Kelola Slider</a></li>
            <li><a href="{{ route('admin.comments.index') }}" class="active"><i class="bi bi-chat-dots"></i> Kelola Komentar</a></li>
        </ul>
    </aside>
    <main class="admin-content">
        <div class="admin-header"><h2 class="admin-title">Kelola Komentar</h2></div>
        @if(session('success'))
            <div class="alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div>
        @endif
        <div class="data-table-card">
            <table class="data-table">
                <thead>
                    <tr><th>No</th><th>Berita</th><th>Nama</th><th>Email</th><th>Komentar</th><th>Tanggal</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration + ($comments->currentPage() - 1) * $comments->perPage() }}</td>
                            <td><strong>{{ Str::limit($comment->news->title, 40) }}</strong></td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ Str::limit($comment->comment, 60) }}</td>
                            <td>{{ $comment->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center"><div class="empty-state"><i class="bi bi-chat-dots"></i><p>Belum ada komentar</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $comments->links() }}</div>
    </main>
</div>
@endsection
