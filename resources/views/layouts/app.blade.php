<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- <title>{{ config('app.name', 'Portal Berita') }}</title> -->
    <title>Berita</title>
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

        .article-page {
            background: var(--bg-light);
        }

        .article-detail {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            margin-bottom: 2rem;
        }

        .article-header {
            margin-bottom: 2rem;
        }

        .article-category {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.3;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .article-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .meta-item i {
            font-size: 1.1rem;
        }

        .article-tags {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .tag-badge {
            background: var(--bg-light);
            color: var(--text-dark);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .tag-badge:hover {
            background: var(--primary-color);
            color: white;
        }

        .article-image {
            margin: 2rem 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin: 2rem 0;
        }

        .article-actions {
            margin: 3rem 0;
            padding: 2rem;
            background: var(--bg-light);
            border-radius: 16px;
        }

        .actions-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--primary-color);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-pdf {
            background: #dc2626;
            color: white;
        }

        .btn-facebook {
            background: #1877f2;
            color: white;
        }

        .btn-twitter {
            background: #1da1f2;
            color: white;
        }

        .btn-whatsapp {
            background: #25d366;
            color: white;
        }

        .btn-copy {
            background: var(--primary-color);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .comments-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .comment-form-card {
            background: var(--bg-light);
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .login-required {
            text-align: center;
            padding: 2rem;
        }

        .login-required i {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .login-required h5 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.75rem;
        }

        .login-required p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--accent-color);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #d63851;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(233, 69, 96, 0.3);
            color: white;
        }

        .form-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.1);
        }

        .error-text {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .logged-user-info {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
        }

        .logged-user-info i {
            font-size: 1.5rem;
        }

        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            background: #252541;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 26, 46, 0.2);
        }

        .comments-list {
            margin-top: 2rem;
        }

        .comment-item {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            background: var(--bg-light);
            border-radius: 16px;
            margin-bottom: 1rem;
        }

        .comment-avatar i {
            font-size: 2.5rem;
            color: var(--text-light);
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .comment-header strong {
            color: var(--primary-color);
            font-size: 1rem;
        }

        .comment-date {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .comment-text {
            color: var(--text-dark);
            line-height: 1.6;
            margin: 0;
        }

        .empty-comments {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-light);
        }

        .empty-comments i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .related-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .related-item {
            display: flex;
            gap: 1rem;
            text-decoration: none;
            color: inherit;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .related-item:hover {
            background: var(--bg-light);
        }

        .related-item img, .related-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .related-placeholder {
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--text-light);
        }

        .related-content h5 {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .related-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .article-detail {
                padding: 2rem 1.5rem;
            }
            .article-title {
                font-size: 1.75rem;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }

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
            flex-wrap: wrap;
            gap: 1rem;
        }
        .admin-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        .data-table-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table thead {
            background: var(--bg-light);
        }
        .data-table th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
        }
        .data-table tbody tr:last-child td {
            border-bottom: none;
        }
        .data-table tbody tr:hover {
            background: var(--bg-light);
        }
        .data-table code {
            background: var(--bg-light);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.85rem;
            color: var(--accent-color);
        }
        .badge-count {
            background: var(--primary-color);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-category {
            background: var(--accent-color);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-views {
            background: var(--bg-light);
            color: var(--text-dark);
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }
        .btn-edit:hover {
            background: #fde68a;
        }
        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
        }
        .btn-delete:hover {
            background: #fecaca;
        }
        .btn-view {
            background: #dbeafe;
            color: #1e40af;
        }
        .btn-view:hover {
            background: #bfdbfe;
        }
        .form-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 2rem;
        }
        .form-help {
            display: block;
            margin-top: 0.5rem;
            color: var(--text-light);
            font-size: 0.85rem;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn-cancel {
            background: var(--bg-light);
            color: var(--text-dark);
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-cancel:hover {
            background: var(--border-color);
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
            .data-table {
                font-size: 0.85rem;
            }
            .data-table th,
            .data-table td {
                padding: 0.75rem 1rem;
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
    <button class="chat-toggle-btn" onclick="toggleChat()" style="position: fixed; bottom: 30px; right: 30px; width: 64px; height: 64px; border-radius: 20px; background: #1a1a2e; color: white; border: none; box-shadow: 0 8px 24px rgba(26,26,46,0.25); font-size: 28px; z-index: 1050; cursor: pointer; transition: all 0.3s ease;">
        <i class="bi bi-robot"></i>
    </button>

    <div class="chat-overlay" id="chatOverlay" onclick="toggleChat()"></div>

    <div class="chat-sidebar" id="chatSidebar">
        <div class="chat-header">
            <div>
                <h5 class="mb-0"><i class="bi bi-robot"></i> AI Assistant</h5>
                <small>Gemini dengan sedikit bumbu API dari Satria</small>
            </div>
            <button class="btn btn-link text-white" onclick="toggleChat()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="chat-messages" id="chatMessages">
            <div class="chat-message bot">
                <div class="bubble">
                    Halo! 👋 Saya asisten AI untuk website berita ini. Ada yang bisa saya bantu?
                </div>
            </div>
        </div>

        <div class="typing-indicator" id="typingIndicator">
            <i class="bi bi-three-dots"></i> AI sedang mengetik...
        </div>

        <div class="chat-input-area">
            <form id="chatForm" onsubmit="sendMessage(event)">
                <div class="input-group">
                    <input type="text" class="form-control" id="chatInput"
                           placeholder="Ketik pesan Anda..." required>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Berita 👍️
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm px-3" style="background: var(--accent-color); color: white; border-radius: 10px;" href="{{ route('register') }}">Daftar</a>
                                </li>
                            @endif
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
                <p class="mb-0">Website Berita Terbaik Sepanjang Sejarah Sejak Jaman Yunani.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleChat() {
            const sidebar = document.getElementById('chatSidebar');
            const overlay = document.getElementById('chatOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        async function sendMessage(event) {
            event.preventDefault();

            const input = document.getElementById('chatInput');
            const message = input.value.trim();

            if (!message) return;

            addMessage(message, 'user');
            input.value = '';

            const typingIndicator = document.getElementById('typingIndicator');
            typingIndicator.classList.add('active');

            try {
                const response = await fetch('{{ route("chatbot.chat") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();

                typingIndicator.classList.remove('active');

                if (data.reply) {
                    addMessage(data.reply, 'bot');
                } else if (data.error) {
                    addMessage('Maaf, terjadi kesalahan: ' + data.error, 'bot');
                }
            } catch (error) {
                typingIndicator.classList.remove('active');
                addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
            }
        }

        function addMessage(text, sender) {
            const messagesContainer = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message ${sender}`;

            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            bubble.textContent = text;

            messageDiv.appendChild(bubble);
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    </script>
</body>
</html>
