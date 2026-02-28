@extends('layouts.app')
@section('title', 'Edit Kegiatan')
@section('content')
@section('page-title', 'Edit Kegiatan')
@section('breadcrumb-sub', 'Perbarui data kegiatan')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.kegiatan.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Edit Kegiatan</h4>
            <p class="text-muted mb-0">{{ $kegiatan->judul }}</p>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control rounded-3 @error('judul') is-invalid @enderror" value="{{ old('judul', $kegiatan->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select rounded-3">
                            <option value="">Pilih Kategori</option>
                            @foreach(['Pendidikan','Sosial','Lingkungan','Kesehatan','Kebudayaan','Lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $kegiatan->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" class="form-control rounded-3 @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $kegiatan->lokasi) }}" required>
                        @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah Partisipan</label>
                        <input type="number" name="jumlah_partisipan" class="form-control rounded-3" value="{{ old('jumlah_partisipan', $kegiatan->jumlah_partisipan) }}" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control rounded-3" value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" name="waktu_mulai" class="form-control rounded-3" value="{{ old('waktu_mulai', $kegiatan->waktu_mulai) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control rounded-3" value="{{ old('waktu_selesai', $kegiatan->waktu_selesai) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gambar / Poster</label>
                        <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">
                        @if($kegiatan->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="rounded-3" style="max-height:120px;">
                                <small class="d-block text-muted mt-1">Gambar saat ini. Upload baru untuk mengganti.</small>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tambah Foto Dokumentasi</label>
                        <input type="file" name="dokumentasi[]" class="form-control rounded-3 @error('dokumentasi.*') is-invalid @enderror" accept="image/*" multiple>
                        @error('dokumentasi.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Bisa pilih banyak foto baru. Maks 10 total, masing-masing 5MB</small>
                    </div>
                    @if($kegiatan->dokumentasi && count($kegiatan->dokumentasi) > 0)
                    <div class="col-12">
                        <label class="form-label fw-bold">Foto Dokumentasi Saat Ini</label>
                        <div class="row g-3">
                            @foreach($kegiatan->dokumentasi as $idx => $dok)
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="position-relative border rounded-3 overflow-hidden">
                                    <img src="{{ asset('storage/' . $dok) }}" class="w-100" style="height:100px; object-fit:cover;">
                                    <div class="position-absolute top-0 end-0 p-1">
                                        <label class="btn btn-sm btn-danger rounded-circle" style="width:24px; height:24px; padding:0; line-height:24px; font-size:12px;" title="Hapus foto ini">
                                            <input type="checkbox" name="hapus_dokumentasi[]" value="{{ $dok }}" class="d-none" onchange="this.closest('div').closest('div').closest('div').style.opacity = this.checked ? '0.4' : '1'">
                                            &times;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted mt-1 d-block">Klik tombol <span class="text-danger fw-bold">&times;</span> untuk menandai foto yang ingin dihapus.</small>
                    </div>
                    @endif
                </div>
                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-danger px-5 rounded-3">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
