@extends('layouts.app')

@section('title', 'Edit Informasi')

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
        border-color: #dc2626;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
    }
    .btn-update { background: #dc2626; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 700; border: none; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('admin.informasi.index') }}" class="text-decoration-none small fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <h2 class="fw-bold text-dark mt-2">Edit Konten Informasi</h2>
            </div>

            <div class="form-card text-start">
                <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Judul Informasi</label>
                        <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="Pendaftaran" {{ $informasi->kategori == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                            <option value="Kegiatan" {{ $informasi->kategori == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Lainnya" {{ $informasi->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Isi Informasi</label>
                        <textarea name="isi" class="form-control" rows="10" required>{{ $informasi->isi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Poster/Gambar (Opsional)</label>
                        @if($informasi->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="Current" class="img-thumbnail" style="max-height: 150px;">
                                <p class="small text-muted">Gambar saat ini. Upload baru untuk mengganti.</p>
                            </div>
                        @endif
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        <div class="form-text small">Format: JPG, PNG, GIF. Maks 5MB.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Galeri Foto Kegiatan (Opsional)</label>
                        @if($informasi->galeri && count($informasi->galeri) > 0)
                            <div class="mb-2 d-flex flex-wrap gap-2">
                                @foreach($informasi->galeri as $foto)
                                    <img src="{{ asset('storage/' . $foto) }}" alt="Gallery" class="img-thumbnail" style="max-height: 80px;">
                                @endforeach
                            </div>
                            <p class="small text-muted">Galeri saat ini. Upload baru akan menambah ke galeri.</p>
                        @endif
                        <input type="file" name="galeri[]" id="galeri" class="form-control" accept="image/*" multiple>
                        <div class="form-text small">Maksimal 3 foto. Format: JPG, PNG, GIF. Maks 5MB/foto.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-update px-5 shadow-sm">
                            <i class="fas fa-sync-alt me-2"></i> Perbarui Data
                        </button>
                        <a href="{{ route('admin.informasi.index') }}" class="btn btn-light px-4 border rounded-3 text-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const maxSize = 5 * 1024 * 1024; // 5MB per file
const maxGaleriCount = 3;

function validateGambar(input) {
    if (input.files && input.files[0]) {
        if (input.files[0].size > maxSize) {
            alert('File "' + input.files[0].name + '" melebihi batas 5MB! Ukuran: ' + (input.files[0].size / 1024 / 1024).toFixed(2) + 'MB');
            input.value = '';
            return false;
        }
    }
    return true;
}

function validateGaleri(input) {
    if (input.files) {
        if (input.files.length > maxGaleriCount) {
            alert('Maksimal ' + maxGaleriCount + ' foto galeri! Anda memilih ' + input.files.length + ' foto.');
            input.value = '';
            return false;
        }
        let totalSize = 0;
        for (let file of input.files) {
            if (file.size > maxSize) {
                alert('File "' + file.name + '" melebihi batas 5MB per file! Ukuran: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
                input.value = '';
                return false;
            }
            totalSize += file.size;
        }
        if (totalSize > maxSize * maxGaleriCount) {
            alert('Total ukuran galeri terlalu besar! Maks 15MB total. Ukuran Anda: ' + (totalSize / 1024 / 1024).toFixed(2) + 'MB');
            input.value = '';
            return false;
        }
    }
    return true;
}

document.getElementById('gambar')?.addEventListener('change', function() { validateGambar(this); });
document.getElementById('galeri')?.addEventListener('change', function() { validateGaleri(this); });
</script>
@endsection