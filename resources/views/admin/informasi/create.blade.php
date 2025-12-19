@extends('layouts.app')

@section('title', 'Tambah Informasi')

@section('content')
<style>
    body { background-color: #f4f7fa; }
    .form-card {
        background: white;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
    }
    .form-label { font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 10px; }
    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
    }
    .form-control:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
    .btn-save { background: #2563eb; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 700; border: none; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('admin.informasi.index') }}" class="text-decoration-none small fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <h2 class="fw-bold text-dark mt-2">Buat Informasi Baru</h2>
            </div>

            <div class="form-card">
                <form action="{{ route('admin.informasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Judul Informasi</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul yang menarik..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Isi Informasi Lengkap</label>
                        <textarea name="isi" class="form-control" rows="10" placeholder="Tuliskan detail informasi di sini..." required></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-save px-5 shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Informasi
                        </button>
                        <a href="{{ route('admin.informasi.index') }}" class="btn btn-light px-4 border rounded-3 text-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection