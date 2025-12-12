@extends('layouts.app')

@push('styles')
<style>
.auth-page {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-light);
    padding: 2rem 1rem;
}
.auth-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}
.auth-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}
.auth-header p {
    color: var(--text-light);
    font-size: 0.95rem;
}
.auth-divider {
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
}
.auth-divider::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    height: 1px;
    background: var(--border-color);
}
.auth-divider span {
    background: white;
    padding: 0 1rem;
    position: relative;
    color: var(--text-light);
    font-size: 0.9rem;
}
.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    color: var(--text-light);
}
.auth-footer a {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 600;
}
.auth-footer a:hover {
    text-decoration: underline;
}
.w-100 {
    width: 100%;
}
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Buat Akun Baru</h2>
            <p>Daftar untuk mulai membaca dan berkomentar</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="nama@email.com" required>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Minimal 8 karakter" required>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Ketik ulang password" required>
            </div>

            <button type="submit" class="btn-submit w-100">
                <i class="bi bi-person-plus"></i> Daftar
            </button>
        </form>

        <div class="auth-divider">
            <span>atau</span>
        </div>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk Sekarang</a>
        </div>
    </div>
</div>
@endsection
