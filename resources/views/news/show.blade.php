@extends('layouts.app')

@section('content')
<div class="article-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="article-detail">
                    <div class="article-header">
                        <span class="article-category">{{ $news->category->name }}</span>
                        <h1 class="article-title">{{ $news->title }}</h1>

                        <div class="article-meta">
                            <div class="meta-item">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $news->user->name }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $news->created_at->format('d F Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-eye"></i>
                                <span>{{ $news->views }} views</span>
                            </div>
                        </div>

                        @if($news->tags->count() > 0)
                            <div class="article-tags">
                                @foreach($news->tags as $tag)
                                    <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="tag-badge">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($news->image)
                        <div class="article-image">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                        </div>
                    @endif

                    <div class="article-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <div class="article-actions">
                        <h5 class="actions-title">Bagikan & Download</h5>
                        <div class="action-buttons">
                            <a href="{{ route('news.download', $news->slug) }}" class="action-btn btn-pdf">
                                <i class="bi bi-file-pdf"></i> Download PDF
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                               target="_blank" class="action-btn btn-facebook">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                               target="_blank" class="action-btn btn-twitter">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('news.show', $news->slug)) }}"
                               target="_blank" class="action-btn btn-whatsapp">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="copyLink()" class="action-btn btn-copy">
                                <i class="bi bi-link-45deg"></i> Salin Link
                            </button>
                        </div>
                    </div>
                </article>

                <section class="comments-section">
                    <h3 class="section-title">Komentar ({{ $news->comments->count() }})</h3>

                    @if(session('success'))
                        <div class="alert-success">
                            <i class="bi bi-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="comment-form-card">
                        @guest
                            <div class="login-required">
                                <i class="bi bi-lock"></i>
                                <h5>Login untuk Berkomentar</h5>
                                <p>Anda harus login terlebih dahulu untuk dapat memberikan komentar.</p>
                                <a href="{{ route('login') }}" class="btn-login">
                                    <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
                                </a>
                            </div>
                        @else
                            <h5 class="form-title">Tulis Komentar</h5>
                            <form action="{{ route('comments.store', $news) }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                <div class="logged-user-info">
                                    <i class="bi bi-person-circle"></i>
                                    Komentar sebagai <strong>{{ Auth::user()->name }}</strong>
                                </div>
                                <div class="form-group">
                                    <label>Komentar</label>
                                    <textarea name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror"
                                              placeholder="Tulis komentar Anda..." required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-send"></i> Kirim Komentar
                                </button>
                            </form>
                        @endguest
                    </div>

                    <div class="comments-list">
                        @forelse($news->comments as $comment)
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <strong>{{ $comment->name }}</strong>
                                        <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="comment-text">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="empty-comments">
                                <i class="bi bi-chat-dots"></i>
                                <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <aside class="col-lg-4">
                @if($relatedNews->count() > 0)
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Berita Terkait</h4>
                        <div class="related-list">
                            @foreach($relatedNews as $item)
                                <a href="{{ route('news.show', $item->slug) }}" class="related-item">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                    @else
                                        <div class="related-placeholder">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                    @endif
                                    <div class="related-content">
                                        <h5>{{ Str::limit($item->title, 70) }}</h5>
                                        <span class="related-date">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>

<script>
function copyLink() {
    const url = '{{ route('news.show', $news->slug) }}';
    navigator.clipboard.writeText(url).then(function() {
        alert('Link berhasil disalin!');
    });
}
</script>
@endsection
