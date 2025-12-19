@extends('layouts.app')
@section('title', 'Reset Password Admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 24px;">
                <div class="card-header border-0 py-4 text-center text-white" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);">
                    <i class="fas fa-key fs-2 mb-3"></i>
                    <h5 class="fw-bold mb-0">Reset Kredensial Admin</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <p class="text-center small text-secondary mb-4">Mengubah password untuk admin: <br><strong>{{ $admin->name }}</strong></p>
                    <form method="POST" action="{{ route('admin.akun.reset.update', $admin->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-dark mb-2">Password Baru</label>
                            <input type="password" name="password" class="form-control p-3 rounded-3 border-light bg-light" placeholder="••••••••" required>
                        </div>
                        <div class="mb-4">
                            <label class="small fw-bold text-dark mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control p-3 rounded-3 border-light bg-light" placeholder="••••••••" required>
                        </div>
                        <button class="btn btn-warning w-100 py-3 rounded-3 fw-bold border-0 text-white mb-2" style="background: #f59e0b;">Reset Password Sekarang</button>
                        <a href="{{ route('admin.akun.index') }}" class="btn btn-link w-100 text-secondary text-decoration-none small">Kembali ke Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection