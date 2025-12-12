@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow">
                <div class="card-body py-5">
                    <h1 class="display-1 text-danger">403</h1>
                    <h3 class="mb-3">Akses Ditolak</h3>
                    <p class="text-muted mb-4">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                        Hanya admin yang dapat mengakses dashboard admin.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="bi bi-house"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
