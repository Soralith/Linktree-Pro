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
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Selamat Datang Kembali</h2>
            <p>Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password" required>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-submit w-100">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>

        <div class="auth-divider">
            <span>atau</span>
        </div>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
