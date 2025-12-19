@extends('layouts.app')
@section('title', 'Edit Admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4 text-center">
                <h3 class="fw-bold text-dark">Perbarui Profil Admin</h3>
                <p class="text-secondary small">ID Admin: #{{ $admin->id }}</p>
            </div>
            <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
                <form method="POST" action="{{ route('admin.akun.update', $admin->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-2">Nama Pengguna</label>
                        <input class="form-control border-0 bg-light p-3 rounded-3" name="name" value="{{ $admin->name }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold text-muted mb-2">Email Terdaftar</label>
                        <input class="form-control border-0 bg-light p-3 rounded-3" name="email" value="{{ $admin->email }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning flex-grow-1 py-3 rounded-3 fw-bold border-0 text-white" style="background: #f59e0b;">Update Profil</button>
                        <a href="{{ route('admin.akun.index') }}" class="btn btn-light py-3 px-4 rounded-3 fw-bold border">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection