@extends('layouts.app')

@section('title', 'Edit Data Pendaftaran')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
        color: #334155;
    }

    .edit-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .edit-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(185, 28, 28, 0.8) 100%);
        color: white;
        padding: 40px;
        border-radius: 24px;
        margin-bottom: 30px;
    }

    .form-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: #64748b;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        transition: 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .btn-save {
        background: #dc2626;
        color: white;
        padding: 14px 32px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
    }

    .btn-save:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        color: white;
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
        padding: 14px 32px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .current-file-badge {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        padding: 10px 16px;
        border-radius: 12px;
        color: #166534;
        font-size: 0.85rem;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .edit-card {
            padding: 20px 16px;
            border-radius: 16px;
        }

        .edit-header {
            padding: 25px 18px;
            border-radius: 16px;
        }

        .edit-header h2 {
            font-size: 1.2rem;
        }
    }
</style>

<div class="container py-4">
    <div class="edit-header" data-aos="fade-down">
        <h2 class="fw-bold mb-1"><i class="fas fa-edit me-2"></i>Edit Data Pendaftaran</h2>
        <p class="mb-0 opacity-90">Perbarui data pendaftaran Anda sebelum diverifikasi admin.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4" data-aos="zoom-in">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Terjadi Kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="edit-card" data-aos="fade-up">
        <form action="{{ route('user.pendaftaran.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" 
                           value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="email_display" class="form-label">Email</label>
                    <input type="email" id="email_display" class="form-control bg-light" 
                           value="{{ $pendaftaran->email }}" disabled>
                    <small class="text-muted mt-1 d-block"><i class="fas fa-lock me-1"></i>Email tidak dapat diubah.</small>
                </div>

                <div class="col-md-6">
                    <label for="no_hp" class="form-label">Nomor HP/WhatsApp</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" 
                           value="{{ old('no_hp', $pendaftaran->no_hp) }}" required>
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                </div>

                <div class="col-12">
                    <label for="berkas" class="form-label">Upload Berkas Baru (Opsional)</label>
                    <input type="file" name="berkas" id="berkas" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    <small class="text-muted mt-1 d-block">Format: PDF, JPG, JPEG, PNG. Maks 5MB. Kosongkan jika tidak ingin mengganti.</small>

                    @if($pendaftaran->berkas)
                        <div class="current-file-badge mt-3">
                            <i class="fas fa-file-check me-2"></i>
                            Berkas saat ini: <strong>{{ basename($pendaftaran->berkas) }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-3 mt-5 pt-3 border-top">
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true });
    });
</script>
@endsection
