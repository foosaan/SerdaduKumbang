@extends('layouts.app')
@section('title', 'Tambah Partner')
@section('content')
@section('page-title', 'Tambah Partner')
@section('breadcrumb-sub', 'Daftarkan mitra baru')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.partner.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 max-w-2xl mx-auto">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Tambah Partner</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Partner <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Link (Opsional)</label>
                    <input type="url" name="link" class="form-control rounded-3 @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="https://...">
                    @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Logo <span class="text-danger">*</span></label>
                    <input type="file" name="logo" class="form-control rounded-3 @error('logo') is-invalid @enderror" accept="image/*" required>
                    @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">Format: JPG, PNG, SVG, WebP. Maks 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary px-5 rounded-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
