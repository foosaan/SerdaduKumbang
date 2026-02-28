@extends('layouts.app')
@section('title', 'Tambah Kegiatan')
@section('content')
@section('page-title', 'Tambah Kegiatan')
@section('breadcrumb-sub', 'Buat kegiatan baru')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.kegiatan.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Tambah Kegiatan Baru</h4>
            <p class="text-muted mb-0">Isi detail kegiatan relawan</p>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control rounded-3 @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select rounded-3">
                            <option value="">Pilih Kategori</option>
                            <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Lingkungan" {{ old('kategori') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                            <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Kebudayaan" {{ old('kategori') == 'Kebudayaan' ? 'selected' : '' }}>Kebudayaan</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" class="form-control rounded-3 @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" required>
                        @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah Partisipan</label>
                        <input type="number" name="jumlah_partisipan" class="form-control rounded-3" value="{{ old('jumlah_partisipan') }}" placeholder="Opsional" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control rounded-3 @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" name="waktu_mulai" class="form-control rounded-3 @error('waktu_mulai') is-invalid @enderror" value="{{ old('waktu_mulai') }}" required>
                        @error('waktu_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control rounded-3" value="{{ old('waktu_selesai') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gambar / Poster</label>
                        <input type="file" name="gambar" class="form-control rounded-3 @error('gambar') is-invalid @enderror" accept="image/*">
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Format: JPG, PNG, WebP. Maks: 5MB</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Foto Dokumentasi</label>
                        <input type="file" name="dokumentasi[]" class="form-control rounded-3 @error('dokumentasi.*') is-invalid @enderror" accept="image/*" multiple>
                        @error('dokumentasi.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Bisa pilih banyak foto sekaligus. Maks 10 foto, masing-masing 5MB</small>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-danger px-5 rounded-3">
                        <i class="fas fa-save me-2"></i>Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
