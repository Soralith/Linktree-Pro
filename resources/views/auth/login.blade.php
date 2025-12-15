@extends('layouts.app')

@push('styles')
<style>
:root {
    --primary-color: #212529;
    --accent-color: #007bff;
    --bg-light: #f8f9fa;
    --text-dark: #343a40;
    --text-light: #6c757d;
    --border-color: #dee2e6;
    --success-color: #28a745;
    --error-color: #dc3545;
}

.auth-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-light);
    padding: 2rem 1rem;
}

.auth-card {
    background: white;
    border-radius: 12px;
    padding: 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}
.auth-card:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}

.auth-header {
    text-align: center;
    margin-bottom: 2.5rem;
}
.auth-header h2 {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}
.auth-header p {
    color: var(--text-light);
    font-size: 1rem;
    font-weight: 400;
}

.form-group {
    margin-bottom: 1.5rem;
}
.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
    font-size: 0.9rem;
}
.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    color: var(--text-dark);
    transition: border-color 0.3s, box-shadow 0.3s;
}
.form-control:focus {
    border-color: var(--accent-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
}
.form-control::placeholder {
    color: var(--text-light);
    font-style: italic;
}
.form-control.is-invalid {
    border-color: var(--error-color);
}
.error-text {
    display: block;
    color: var(--error-color);
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.form-check {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}
.form-check-input {
    width: 1.25em;
    height: 1.25em;
    margin-right: 0.5rem;
    border-radius: 4px;
    cursor: pointer;
}
.form-check-label {
    font-weight: 500;
    color: var(--text-dark);
    cursor: pointer;
}

.btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    background-color: var(--primary-color);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.1s;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.btn-submit:hover {
    background-color: #343a40;
}
.btn-submit:active {
    transform: translateY(1px);
}
.btn-submit i {
    margin-right: 0.5rem;
    font-size: 1.2rem;
}

.auth-divider {
    text-align: center;
    margin: 2rem 0;
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
    z-index: 1;
}
.auth-divider span {
    background: white;
    padding: 0 1rem;
    position: relative;
    color: var(--text-light);
    font-size: 0.9rem;
    z-index: 2;
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    color: var(--text-light);
    font-size: 0.95rem;
}
.auth-footer a {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s;
}
.auth-footer a:hover {
    color: #0056b3;
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
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password" required>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn-submit w-100">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>
</div>
@endsection