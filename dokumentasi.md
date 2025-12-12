# 📰 Dokumentasi Web Berita Laravel

## 📋 Daftar Isi
1. [Informasi Project](#informasi-project)
2. [Tech Stack](#tech-stack)
3. [Fitur Utama](#fitur-utama)
4. [Struktur Database](#struktur-database)
5. [Instalasi](#instalasi)
6. [Konfigurasi](#konfigurasi)
7. [Penggunaan](#penggunaan)
8. [Struktur Folder](#struktur-folder)
9. [API & Integrasi](#api--integrasi)

---

## 📌 Informasi Project

**Nama Project:** Web Berita Laravel  
**Versi Laravel:** 12.37.0  
**PHP Version:** 8.4.14  
**Database:** MySQL/MariaDB  
**UI Framework:** Bootstrap 5.3.0 (CDN)  
**Authentication:** Laravel Built-in Auth (BUKAN Laravel Breeze/Jetstream)

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 12.x
- **PHP:** 8.4+
- **Database:** MySQL/MariaDB
- **PDF Generator:** barryvdh/laravel-dompdf
- **HTTP Client:** Guzzle (untuk AI Chatbot)

### Frontend
- **CSS Framework:** Bootstrap 5.3.0 (via CDN)
- **Icons:** Bootstrap Icons 1.11.0 (via CDN)
- **Charts:** Chart.js 4.4.0 (via CDN)
- **Carousel:** Bootstrap Carousel (built-in)

### AI Integration
- **AI Provider:** Google Gemini API 2.5 Flash
- **Model:** gemini-2.5-flash (Free Tier)
- **Use Case:** AI Chatbot Assistant

### Authentication
- **Method:** Manual Laravel Authentication
- **BUKAN Laravel Breeze/Jetstream** - dibuat custom menggunakan trait `AuthenticatesUsers` dan `RegistersUsers`
- **Roles:** Admin & User
- **Middleware:** Custom AdminMiddleware

---

## ✨ Fitur Utama

### 🌐 Frontend (User Side)
1. **Homepage Modern**
   - Hero Slider (Banner)
   - Card-based news grid
   - Sidebar kategori & berita populer
   - Search bar
   - Responsive design

2. **Detail Berita**
   - Reading-focused layout
   - Social share buttons (Facebook, Twitter, WhatsApp, Telegram, Email)
   - Copy link feature
   - Download PDF
   - Komentar (login required)
   - Related news sidebar

3. **Sistem Komentar**
   - Login required untuk komentar
   - Auto-approve (langsung tampil)
   - Display nama user yang login

4. **AI Chatbot**
   - Floating button di kanan bawah
   - Sidebar chat slide dari kiri
   - Powered by Gemini 2.5 Flash
   - Real-time conversation

### 🔐 Authentication
1. **Login**
   - Clean card design
   - Remember me feature
   - Redirect ke homepage after login

2. **Register**
   - Automatic role: user
   - Email validation
   - Password confirmation

3. **Roles**
   - **Admin:** Full access ke dashboard & semua fitur
   - **User:** Hanya bisa comment di berita

### 🎛️ Dashboard Admin
1. **Dashboard**
   - Statistics cards (Total Berita, Kategori, Tag, Komentar, User)
   - Chart.js graphs:
     - Line chart: Statistik berita per bulan
     - Doughnut chart: Berita per kategori
   - Latest news list
   - Popular news list
   - Download laporan PDF

2. **Kelola Berita**
   - CRUD berita lengkap
   - Upload thumbnail
   - Multiple tags selection
   - Category dropdown
   - Auto-publish (no draft)
   - Rich text editor area

3. **Kelola Kategori**
   - CRUD kategori
   - Auto-generate slug
   - Counter jumlah berita per kategori

4. **Kelola Tag**
   - CRUD tag
   - Auto-generate slug
   - Counter jumlah berita per tag

5. **Kelola Slider**
   - CRUD banner slider
   - Upload gambar slider
   - Optional link URL
   - Order/urutan slider

6. **Kelola Komentar**
   - View all comments
   - Delete comment
   - No approval needed (auto-approve)

---

## 🗄️ Struktur Database

### Tabel: `users`
```
- id (PK)
- name
- email (unique)
- password
- role (enum: 'admin', 'user')
- email_verified_at
- remember_token
- created_at
- updated_at
```

### Tabel: `categories`
```
- id (PK)
- name
- slug (unique, auto-generated)
- created_at
- updated_at
```

### Tabel: `tags`
```
- id (PK)
- name
- slug (unique, auto-generated)
- created_at
- updated_at
```

### Tabel: `news`
```
- id (PK)
- title
- slug (unique, auto-generated)
- content (text)
- image (nullable)
- category_id (FK -> categories)
- user_id (FK -> users)
- views (default: 0)
- is_published (default: true)
- created_at
- updated_at
```

### Tabel: `news_tag` (Pivot Table)
```
- id (PK)
- news_id (FK -> news)
- tag_id (FK -> tags)
- created_at
- updated_at
```

### Tabel: `comments`
```
- id (PK)
- news_id (FK -> news)
- name
- email
- comment (text)
- is_approved (default: true)
- created_at
- updated_at
```

### Tabel: `sliders`
```
- id (PK)
- title
- image
- link (nullable)
- order (default: 0)
- is_active (default: true)
- created_at
- updated_at
```

---

## 📦 Instalasi

### 1. Clone/Download Project
```bash
# Download atau extract project ke folder
cd web-berita
```

### 2. Install Dependencies
```bash
# Install Composer dependencies
composer install

# Install NPM dependencies (optional, karena pakai CDN)
npm install
```

### 3. Setup Environment
```bash
# Copy .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database
```bash
# Buat database di MySQL
mysql -u root -p
CREATE DATABASE web_berita;
EXIT;

# Edit .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_berita
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Buat Admin User
```bash
php artisan tinker

# Jalankan di tinker:
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'role' => 'admin',
    'password' => 'password123'
]);

exit
```

### 8. Install Package Tambahan
```bash
# PDF Generator
composer require barryvdh/laravel-dompdf
```

### 9. Run Server
```bash
php artisan serve
# Akses: http://127.0.0.1:8000
```

---

## ⚙️ Konfigurasi

### 1. Setup Gemini AI Chatbot
```bash
# Dapatkan API Key dari: https://aistudio.google.com/apikey
# Tambahkan ke .env:
GEMINI_API_KEY=your_api_key_here
```

### 2. File Upload Configuration
Di `config/filesystems.php`, pastikan:
```php
'default' => env('FILESYSTEM_DISK', 'public'),
```

Upload path:
- News images: `storage/app/public/news-images/`
- Slider images: `storage/app/public/sliders/`

### 3. Database Configuration
Di `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_berita
DB_USERNAME=root
DB_PASSWORD=
```

**IMPORTANT:** Gunakan `127.0.0.1` bukan `localhost` untuk koneksi database di Linux.

---

## 📖 Penggunaan

### Akses User
1. **Homepage:** `http://127.0.0.1:8000/`
2. **Detail Berita:** `http://127.0.0.1:8000/berita/{slug}`
3. **Login:** `http://127.0.0.1:8000/login`
4. **Register:** `http://127.0.0.1:8000/register`

### Akses Admin
1. **Dashboard:** `http://127.0.0.1:8000/admin/dashboard`
2. **Kelola Berita:** `http://127.0.0.1:8000/admin/news`
3. **Kelola Kategori:** `http://127.0.0.1:8000/admin/categories`
4. **Kelola Tag:** `http://127.0.0.1:8000/admin/tags`
5. **Kelola Slider:** `http://127.0.0.1:8000/admin/sliders`
6. **Kelola Komentar:** `http://127.0.0.1:8000/admin/comments`
7. **Download Laporan:** `http://127.0.0.1:8000/admin/download-report`

### Default Login Credentials
```
Email: admin@example.com
Password: password123
```

---

## 📁 Struktur Folder

```
web-berita/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── NewsController.php (PDF)
│   │   │   ├── CommentController.php
│   │   │   ├── ChatbotController.php
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── ...
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── NewsController.php
│   │   │       ├── CategoryController.php
│   │   │       ├── TagController.php
│   │   │       ├── SliderController.php
│   │   │       └── CommentController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── News.php
│       ├── Category.php
│       ├── Tag.php
│       ├── Comment.php
│       └── Slider.php
├── database/
│   └── migrations/
│       ├── 2024_01_01_000001_create_categories_table.php
│       ├── 2024_01_01_000002_create_tags_table.php
│       ├── 2024_01_01_000003_create_news_table.php
│       ├── 2024_01_01_000004_create_news_tag_table.php
│       ├── 2024_01_01_000005_create_comments_table.php
│       ├── 2024_01_01_000006_add_role_to_users_table.php
│       └── 2024_01_01_000007_create_sliders_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── home.blade.php
│       ├── news/
│       │   └── show.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   └── passwords/
│       │       ├── email.blade.php
│       │       └── reset.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── news/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── categories/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── tags/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── sliders/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   └── comments/
│       │       └── index.blade.php
│       ├── pdf/
│       │   ├── news.blade.php
│       │   └── report.blade.php
│       └── errors/
│           └── 403.blade.php
├── routes/
│   └── web.php
├── public/
│   └── storage/ (symlink)
└── storage/
    └── app/
        └── public/
            ├── news-images/
            └── sliders/
```

---

## 🔌 API & Integrasi

### 1. Gemini AI Chatbot
**Endpoint:** `/chatbot`  
**Method:** POST  
**Request:**
```json
{
  "message": "Halo, apa kabar?"
}
```
**Response:**
```json
{
  "reply": "Halo! Kabar baik, terima kasih. Ada yang bisa saya bantu?"
}
```

**Model:** gemini-2.5-flash  
**Max Tokens:** 800  
**Temperature:** 0.7

### 2. Download PDF Berita
**Endpoint:** `/berita/{slug}/download`  
**Method:** GET  
**Response:** PDF File

### 3. Download Laporan PDF
**Endpoint:** `/admin/download-report`  
**Method:** GET  
**Response:** PDF File (daftar semua berita)

---

## 🎨 Design System

### Color Palette
```css
--primary-color: #1a1a2e (Dark Navy)
--accent-color: #e94560 (Vibrant Red)
--text-dark: #2d3436 (Charcoal)
--text-light: #636e72 (Gray)
--bg-light: #f8f9fa (Light Gray)
--border-color: #e9ecef (Border Gray)
```

### Typography
- **Font Family:** -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto
- **Headings:** 700 (Bold)
- **Body:** 400 (Regular)
- **Line Height:** 1.6

### Components
- **Border Radius:** 12px - 20px
- **Shadows:** 0 4px 20px rgba(0,0,0,0.08)
- **Transitions:** all 0.3s ease

---

## 🚀 Performance Tips

1. **Enable Cache**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Optimize Images**
- Resize gambar sebelum upload
- Maksimal 2MB per gambar
- Format: JPG/PNG/GIF

3. **Database Indexing**
- Index pada kolom: `slug`, `category_id`, `user_id`

---

## 🔒 Security

### Authentication
- Password di-hash menggunakan `bcrypt`
- CSRF protection di semua form
- Middleware `auth` untuk routes yang memerlukan login
- Middleware `admin` untuk routes admin only

### File Upload
- Validasi tipe file (image only)
- Validasi ukuran maksimal 2MB
- Storage di folder `public/storage`

### API Security
- CSRF token required untuk semua POST request
- Gemini API Key disimpan di `.env` (tidak di-commit ke git)

---

## 📝 Catatan Penting

1. **Jangan commit file `.env`** ke git (sudah ada di `.gitignore`)
2. **Backup database** secara berkala
3. **Gemini API Free Tier** memiliki limit usage per hari
4. **Chart.js** di-load via CDN, pastikan internet connection
5. **Bootstrap 5.3.0** di-load via CDN (tidak perlu `npm run build`)
6. **Storage link** harus dibuat dengan `php artisan storage:link`
7. **Gunakan 127.0.0.1** bukan localhost untuk database connection di Linux

---

## 🐛 Troubleshooting

### Error: SQLSTATE[HY000] [2002] Connection refused
**Solusi:** 
```bash
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

### Error: Storage link not found
**Solusi:**
```bash
rm -rf public/storage
php artisan storage:link
```

### Error: Gemini API 403 - API key leaked
**Solusi:**
- Buat API key baru di https://aistudio.google.com/apikey
- Update `.env` dengan key baru
- Restart server: `php artisan serve`

### CSS tidak update setelah perubahan
**Solusi:**
- Hard refresh: Ctrl + Shift + R
- Clear cache browser
- Gunakan Incognito mode untuk test

---

## 📧 Support & Contact

Jika ada pertanyaan atau issue, silakan:
1. Check dokumentasi ini terlebih dahulu
2. Cek Laravel Documentation: https://laravel.com/docs
3. Cek Bootstrap Documentation: https://getbootstrap.com/docs

---

**© 2025 Web Berita Laravel. All Rights Reserved.**
