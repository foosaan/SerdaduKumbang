@extends('layouts.app')
@section('title', 'Tambah Admin')

@section('content')
<style>
    body { background-color: #f4f7fa; }
    .form-card { background: white; border-radius: 24px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .form-control { border-radius: 12px; padding: 12px 16px; border: 1.5px solid #e2e8f0; background-color: #f8fafc; }
    .form-control:focus { border-color: #2563eb; background-color: #fff; box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4">
                <a href="{{ route('admin.akun.index') }}" class="text-decoration-none small fw-bold"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                <h3 class="fw-bold text-dark mt-2">Daftarkan Admin Baru</h3>
            </div>
            <div class="form-card">
                <form method="POST" action="{{ route('admin.akun.store') }}">
                    @csrf
                    <div class="mb-3"><input class="form-control" name="name" placeholder="Nama Lengkap" required></div>
                    <div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Alamat Email" required></div>
                    <div class="mb-3"><input class="form-control" name="password" type="password" placeholder="Password Utama" required></div>
                    <div class="mb-4"><input class="form-control" name="password_confirmation" type="password" placeholder="Konfirmasi Password"></div>
                    
                    <button class="btn btn-primary w-100 py-3 rounded-3 fw-bold border-0 shadow-sm" style="background: #2563eb;">Simpan Akun Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection