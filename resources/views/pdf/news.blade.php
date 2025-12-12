<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $news->title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .meta {
            color: #666;
            margin: 20px 0;
            font-size: 14px;
        }
        .content {
            text-align: justify;
            font-size: 14px;
        }
        .tags {
            margin-top: 20px;
            padding: 10px;
            background: #f5f5f5;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'Portal Berita') }}</h1>
        <p>{{ config('app.url', 'localhost') }}</p>
    </div>

    <h2>{{ $news->title }}</h2>

    <div class="meta">
        <strong>Kategori:</strong> {{ $news->category->name }} |
        <strong>Penulis:</strong> {{ $news->user->name }} |
        <strong>Tanggal:</strong> {{ $news->created_at->format('d F Y, H:i') }} |
        <strong>Views:</strong> {{ $news->views }}
    </div>

    @if($news->tags->count() > 0)
        <div class="tags">
            <strong>Tag:</strong>
            @foreach($news->tags as $tag)
                #{{ $tag->name }}{{ !$loop->last ? ', ' : '' }}
            @endforeach
        </div>
    @endif

    <div class="content">
        {!! nl2br(e($news->content)) !!}
    </div>

    <div class="footer">
        <p>Dokumen ini di-generate pada {{ date('d F Y, H:i') }}</p>
        <p>Website Berita, Semua Hak Dilindungi. 😦</p>
    </div>
</body>
</html>
