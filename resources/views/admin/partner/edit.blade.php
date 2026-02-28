@extends('layouts.app')
@section('title', 'Edit Partner')
@section('content')
@section('page-title', 'Edit Partner')
@section('breadcrumb-sub', 'Perbarui data mitra')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.partner.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 max-w-2xl mx-auto">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Edit Partner</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Partner <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name', $partner->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Link (Opsional)</label>
                    <input type="url" name="link" class="form-control rounded-3 @error('link') is-invalid @enderror" value="{{ old('link', $partner->link) }}" placeholder="https://...">
                    @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Logo</label>
                    <input type="file" name="logo" class="form-control rounded-3 @error('logo') is-invalid @enderror" accept="image/*">
                    @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $partner->logo) }}" class="rounded bg-light p-2" style="height: 60px;">
                        <small class="d-block text-muted mt-1">Logo saat ini. Upload baru untuk mengganti.</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-5 rounded-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
