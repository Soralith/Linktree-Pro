<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>{{ config('app.name', 'Portal Berita') }}</title> -->
    <title>TEFA Etalase | Produk TEFA PPLG-RPL SMKN 11 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1a1a2e;
            --accent-color: #e94560;
            --text-dark: #2d3436;
            --text-light: #636e72;
            --bg-light: #f8f9fa;
            --border-color: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: var(--text-dark);
            background: #ffffff;
            line-height: 1.6;
        }
        
        .navbar {
            background: #ffffff !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .hero-section {
            background: var(--bg-light);
            padding: 2rem 0;
        }
        
        .hero-carousel {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .hero-carousel img {
            height: 500px;
            object-fit: cover;
        }
        
        .carousel-caption {
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            bottom: 0;
            left: 0;
            right: 0;
            padding: 3rem 2rem 2rem;
        }
        
        .carousel-caption h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        
        .search-box {
            position: relative;
            width: 300px;
        }
        
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }
        
        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.1);
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .news-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }
        
        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            border-color: transparent;
        }
        
        .news-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .news-card-image {
            position: relative;
            width: 100%;
            height: 220px;
            overflow: hidden;
            background: var(--bg-light);
        }
        
        .news-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .news-card:hover .news-card-image img {
            transform: scale(1.05);
        }
        
        .news-card-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--text-light);
        }
        
        .news-card-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--accent-color);
            color: white;
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .news-card-content {
            padding: 1.5rem;
        }
        
        .news-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 0.75rem;
            color: var(--primary-color);
        }
        
        .news-card-excerpt {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .news-card-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: var(--text-light);
            flex-wrap: wrap;
        }
        
        .news-card-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .sidebar-widget {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .widget-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--primary-color);
        }
        
        .category-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.2s;
            background: var(--bg-light);
        }
        
        .category-item:hover {
            background: var(--accent-color);
            color: white;
        }
        
        .category-count {
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .popular-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .popular-item {
            display: flex;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
        }
        
        .popular-item:hover {
            opacity: 0.8;
        }
        
        .popular-item img, .popular-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }
        
        .popular-placeholder {
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--text-light);
        }
        
        .popular-content h5 {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .popular-views {
            font-size: 0.8rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }
        
        footer {
            background: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }
        
        @media (max-width: 768px) {
            .hero-carousel img {
                height: 300px;
            }
            .news-grid {
                grid-template-columns: 1fr;
            }
            .search-box {
                width: 100%;
            }
        }
    <style>
        .chat-toggle-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: var(--primary-color);
            color: white;
            border: none;
            box-shadow: 0 8px 24px rgba(26, 26, 46, 0.25);
            font-size: 28px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-toggle-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(26, 26, 46, 0.35);
            background: #252541;
        }
        .chat-toggle-btn:active {
            transform: translateY(-2px);
        }
        .chat-toggle-btn::before {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            background: #4ade80;
            border: 3px solid white;
            border-radius: 50%;
            top: 8px;
            right: 8px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }
        .chat-sidebar {
            position: fixed;
            top: 0;
            left: -420px;
            width: 420px;
            height: 100vh;
            background: white;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
            z-index: 1040;
            transition: left 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .chat-sidebar.active {
            left: 0;
        }
        .chat-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1030;
            display: none;
            backdrop-filter: blur(2px);
        }
        .chat-overlay.active {
            display: block;
        }
        .chat-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .chat-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }
        .chat-header small {
            opacity: 0.8;
            font-size: 0.85rem;
        }
        .chat-header button {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 0.5rem;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        .chat-header button:hover {
            opacity: 1;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: var(--bg-light);
        }
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }
        .chat-message {
            margin-bottom: 1rem;
            display: flex;
            gap: 0.75rem;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .chat-message.user {
            justify-content: flex-end;
        }
        .chat-message .bubble {
            max-width: 75%;
            padding: 0.875rem 1.125rem;
            border-radius: 16px;
            word-wrap: break-word;
            line-height: 1.5;
            font-size: 0.95rem;
        }
        .chat-message.bot .bubble {
            background: white;
            color: var(--text-dark);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid var(--border-color);
        }
        .chat-message.user .bubble {
            background: var(--primary-color);
            color: white;
        }
        .chat-input-area {
            padding: 1.25rem;
            background: white;
            border-top: 1px solid var(--border-color);
        }
        .chat-input-area input {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
        }
        .chat-input-area input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.1);
        }
        .chat-input-area button {
            background: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 1.5rem;
            color: white;
            font-weight: 500;
        }
        .chat-input-area button:hover {
            background: #252541;
        }
        .typing-indicator {
            display: none;
            padding: 0.5rem 1.5rem;
            color: var(--text-light);
            font-style: italic;
            font-size: 0.9rem;
        }
        .typing-indicator.active {
            display: block;
        }
        @media (max-width: 768px) {
            .chat-sidebar {
                width: 100%;
                left: -100%;
            }
            .chat-toggle-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 62px;">
                    <!-- <span>{{ config('app.name', 'Laravel') }}</span> -->
                    <span> TEFA ETALASE ELEVEN</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
<!-- 
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form action="{{ route('home') }}" method="GET" class="d-flex mx-auto" style="max-width: 400px; width: 100%;">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari produk..." value="{{ request('search') }}" style="border-radius: 0 8px 8px 0;">
                        </div>
                    </form> -->

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <!-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                </li>
                            @endif -->

                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm px-3" style="background: var(--accent-color); color: white; border-radius: 10px;" href="{{ route('register') }}">Daftar</a>
                                </li>
                            @endif -->
                        @else
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-dark text-white py-4 mt-5">
            <div class="container text-center">
                <!-- <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. Semua Hak Dilindungi.</p> -->
                <p class="mb-0">- Produk TEFA PPLG | Dibuat oleh Ariq Rafif Komara & Tim Pengembang TEFA PPLG 2025-2026 -</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
