@extends('layouts.app')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
    .admin-layout {
        display: flex;
        min-height: calc(100vh - 200px);
        background: var(--bg-light);
    }
    .admin-sidebar {
        width: 280px;
        background: white;
        padding: 2rem 0;
        border-right: 1px solid var(--border-color);
    }
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .sidebar-menu li a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 2rem;
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.2s;
        font-weight: 500;
    }
    .sidebar-menu li a:hover {
        background: var(--bg-light);
        color: var(--primary-color);
    }
    .sidebar-menu li a.active {
        background: var(--primary-color);
        color: white;
        border-right: 4px solid var(--accent-color);
    }
    .admin-content {
        flex: 1;
        padding: 2rem;
    }
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .admin-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        transition: all 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .stat-icon.blue { background: #dbeafe; color: #1e40af; }
    .stat-icon.green { background: #d1fae5; color: #065f46; }
    .stat-icon.cyan { background: #cffafe; color: #155e75; }
    .stat-icon.yellow { background: #fef3c7; color: #92400e; }
    .stat-icon.gray { background: #f3f4f6; color: #374151; }
    .stat-label {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    .chart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .chart-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    .chart-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }
    .news-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .news-list-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    .news-item {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }
    .news-item:last-child {
        border-bottom: none;
    }
    .news-item h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    .news-item small {
        font-size: 0.85rem;
        color: var(--text-light);
    }
    @media (max-width: 992px) {
        .admin-layout {
            flex-direction: column;
        }
        .admin-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid var(--border-color);
        }
        .chart-grid,
        .news-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-layout">
    <aside class="admin-sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="active">
                <i class="bi bi-grid"></i> Dashboard
            </a></li>
            <li><a href="{{ route('admin.news.index') }}">
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
            <h2 class="admin-title">Dashboard Admin</h2>
            <a href="{{ route('admin.download.report') }}" class="btn-submit">
                <i class="bi bi-file-pdf"></i> Download Laporan PDF
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="stat-label">Total Berita</div>
                <div class="stat-value">{{ $totalNews }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-folder"></i>
                </div>
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value">{{ $totalCategories }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cyan">
                    <i class="bi bi-tags"></i>
                </div>
                <div class="stat-label">Total Tag</div>
                <div class="stat-value">{{ $totalTags }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <div class="stat-label">Total Komentar</div>
                <div class="stat-value">{{ $totalComments }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon gray">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-label">Total User</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
        </div>

        <div class="chart-grid">
            <div class="chart-card">
                <h3 class="chart-title">Statistik Berita Per Bulan ({{ date('Y') }})</h3>
                <canvas id="newsChart" style="max-height: 300px;"></canvas>
            </div>
            <div class="chart-card">
                <h3 class="chart-title">Berita Per Kategori</h3>
                <canvas id="categoryChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <div class="news-grid">
            <div class="news-list-card">
                <h3 class="chart-title">Berita Terbaru</h3>
                @foreach($latestNews as $news)
                    <div class="news-item">
                        <h6>{{ Str::limit($news->title, 45) }}</h6>
                        <small>{{ $news->category->name }} · {{ $news->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>

            <div class="news-list-card">
                <h3 class="chart-title">Berita Populer</h3>
                @foreach($popularNews as $news)
                    <div class="news-item">
                        <h6>{{ Str::limit($news->title, 45) }}</h6>
                        <small>{{ $news->views }} views · {{ $news->category->name }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newsCtx = document.getElementById('newsChart');
    const categoryCtx = document.getElementById('categoryChart');

    if (newsCtx && typeof Chart !== 'undefined') {
        const newsChart = new Chart(newsCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Jumlah Berita',
                    data: {!! json_encode($newsData) !!},
                    borderColor: '#1a1a2e',
                    backgroundColor: 'rgba(26, 26, 46, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2.5,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    if (categoryCtx && typeof Chart !== 'undefined') {
        const categoryChart = new Chart(categoryCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoriesChart->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($categoriesChart->pluck('news_count')) !!},
                    backgroundColor: [
                        '#e94560',
                        '#1a1a2e',
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1.5,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
@endsection
