<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Berita</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 30px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        table th {
            background: #333;
            color: white;
            padding: 10px;
            text-align: left;
        }
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table tr:nth-child(even) {
            background: #f5f5f5;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name', 'Portal Berita') }}</h1>
        <h2>Laporan Berita</h2>
        <p>Tanggal: {{ date('d F Y') }}</p>
    </div>

    <p><strong>Total Berita:</strong> {{ $news->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Views</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::limit($item->title, 40) }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->views }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini di-generate pada {{ date('d F Y, H:i') }}</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Semua Hak Dilindungi.</p>
    </div>
</body>
</html>
