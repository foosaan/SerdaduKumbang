@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #fcfdfe;
        color: #334155;
    }

    /* Hero Section - Senada dengan Home/Informasi sebelumnya */
    .registration-hero {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 64, 175, 0.75) 100%);
        color: white;
        padding: 80px 20px;
        border-radius: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(37, 99, 235, 0.15);
        margin-bottom: 40px; /* Overlap effect */
        z-index: 1;
    }

    .registration-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
    }

    /* Container Form yang Lebih Modern */
    .form-container {
        background: white;
        border-radius: 30px;
        padding: 60px 50px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        position: relative;
        z-index: 2;
    }

    .form-title {
        color: #1e3a8a;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    /* Styling Input - Lebih Lega & Fokus */
    .form-label {
        font-weight: 700;
        color: #475569;
        margin-bottom: 10px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .form-label i {
        width: 20px;
        color: #2563eb;
    }

    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        transition: all 0.2s ease-in-out;
        background-color: #f8fafc;
    }

    .form-control:focus, .form-select:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    /* Section Divider - Lebih Minimalis */
    .section-divider {
        margin: 50px 0 30px;
        position: relative;
        display: flex;
        align-items: center;
    }

    .section-divider span {
        background: #eff6ff;
        color: #1d4ed8;
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-divider::after {
        content: "";
        flex-grow: 1;
        height: 1.5px;
        background: #f1f5f9;
        margin-left: 15px;
    }

    /* File Upload - Senada dengan Elemen Biru */
    .file-upload-label {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 40px;
        background: #f8fafc;
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
    }

    .file-upload-label:hover {
        border-color: #2563eb;
        background: #f1f7ff;
    }

    .file-upload-label i {
        font-size: 2.5rem;
        color: #2563eb;
        margin-bottom: 15px;
    }

    /* Action Buttons */
    .btn-submit {
        background: #2563eb;
        color: white;
        padding: 16px 40px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 20px 30px -10px rgba(37, 99, 235, 0.5);
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
        padding: 16px 30px;
        border-radius: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .info-card {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 30px;
        border-left: 4px solid #106ba3;
    }

    .info-card i {
        color: #106ba3;
        font-size: 1.5rem;
        margin-right: 15px;
    }

    .info-card-text {
        color: #1976d2;
        font-weight: 500;
        margin: 0;
    }

/* Tambahkan ini di bagian bawah tag <style> Anda */

@media (max-width: 768px) {
    /* Menyesuaikan Hero Section di HP */
    .registration-hero {
        padding: 60px 15px;
        border-radius: 20px;
    }

    .registration-hero h1 {
        font-size: 1.8rem !important; /* Ukuran judul lebih kecil di HP */
    }

    /* Mengurangi padding container form agar input lebih luas */
    .form-container {
        padding: 30px 20px; /* Padding lebih tipis di HP */
        border-radius: 20px;
    }

    .form-title {
        font-size: 1.5rem !important;
    }

    /* Menyesuaikan divider seksi */
    .section-divider span {
        font-size: 0.7rem;
        padding: 6px 12px;
    }

    /* Menyesuaikan label upload file */
    .file-upload-label {
        padding: 25px 15px;
    }

    .file-upload-label i {
        font-size: 2rem;
    }

    /* Memastikan tombol navigasi (Beranda & Kirim) tidak bertumpuk */
    .d-flex.justify-content-between {
        flex-direction: column; /* Tombol jadi atas-bawah di HP */
        gap: 15px;
    }

    .btn-submit, .btn-back {
        width: 100%; /* Tombol lebar penuh agar mudah ditekan */
        text-align: center;
        padding: 12px;
    }

    /* Info card warning di atas form */
    .info-card {
        padding: 15px;
        font-size: 0.85rem;
    }
}

/* Memperbaiki jarak Row agar tidak terlalu rapat di mobile */
.row.g-4 {
    --bs-gutter-y: 1.5rem;
}
</style>

<div class="container py-4">
    <div class="registration-hero text-center" data-aos="fade-down">
        <div class="hero-content">
            <div class="registration-badge">
                <i class="fas fa-file-signature me-2"></i> Jalur Pendaftaran Online
            </div>
            <h1 class="fw-bold display-4">Daftar Mahasantri Baru</h1>
            <p class="lead mt-3 opacity-90 mx-auto" style="max-width: 700px;">
                Mulailah perjalanan spiritual dan pendidikan Anda bersama kami. Silakan isi formulir di bawah dengan data yang valid.
            </p>
        </div>
    </div>

    <div class="container pb-5">
        {{-- Alerts --}}
        @if(session('error') || $errors->any() || session('success'))
        <div class="mt-5 pt-4" data-aos="fade-up">
            @if(session('error'))
                <div class="alert alert-danger shadow-sm border-0 rounded-4 p-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success shadow-sm border-0 rounded-4 p-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border-0 rounded-4 p-4">
                    <h6 class="fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Mohon Periksa Kembali:</h6>
                    <ul class="mb-0 small mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @endif

        {{-- Info Card --}}
        <div class="info-card d-flex align-items-center">
            <i class="fas fa-info-circle"></i>
            <p class="info-card-text">
                Pastikan semua data yang Anda masukkan sudah benar. Data yang telah dikirim tidak dapat diubah.
            </p>
        </div>

        {{-- Main Form Container --}}
        <div class="form-container mt-5" data-aos="fade-up" data-aos-delay="200">
            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                @csrf

                {{-- Section 1 --}}
                <div class="section-divider">
                    <span>Data Calon Mahasantri</span>
                </div>

                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="nama_lengkap" class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" 
                               class="form-control @error('nama_lengkap') is-invalid @enderror"
                               value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama sesuai KK">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="fas fa-venus-mars"></i> Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilih...</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Section 2 --}}
                    <div class="col-12 mt-5 section-divider">
                        <span>Informasi Kontak</span>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Alamat Email Aktif
                        </label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="email@domain.com">
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">
                            <i class="fas fa-phone"></i> Nomor HP / WhatsApp
                        </label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-map-marked-alt"></i> Alamat Lengkap
                        </label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" 
                                  placeholder="Nama jalan, Nomor rumah, RT/RW, Kecamatan, Kabupaten">{{ old('alamat') }}</textarea>
                    </div>

                    {{-- Section 3 --}}
                    <div class="col-12 mt-5 section-divider">
                        <span>Dokumen Pendukung</span>
                    </div>

                    <div class="col-12">
                        <label class="file-upload-label" for="berkas">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="fw-bold h5 mb-1">Klik untuk Upload Berkas</span>
                            <span class="text-secondary small">Format: PDF, JPG, PNG (Maks. 2MB)</span>
                            <div id="fileNameDisplay" class="mt-3 p-2 bg-white rounded border d-none">
                                <i class="fas fa-file-check text-success small me-2"></i>
                                <span id="fileName" class="text-dark small"></span>
                            </div>
                        </label>
                        <input type="file" name="berkas" id="berkas" class="d-none" onchange="displayFileName(this)">
                    </div>
                </div>

                {{-- Action Footer --}}
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <a href="{{ route('home') }}" class="btn-back">
                        <i class="fas fa-chevron-left me-2"></i> Beranda
                    </a>
                    <button type="submit" class="btn-submit">
                        Kirim Formulir <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    });

    function displayFileName(input) {
    const fileDisplay = document.getElementById('fileNameDisplay');
    const fileNameSpan = document.getElementById('fileName');
    const uploadLabel = document.querySelector('.file-upload-label');
    const uploadIcon = uploadLabel.querySelector('i');

    if (input.files && input.files[0]) {
        const fileName = input.files[0].name;
        fileNameSpan.textContent = fileName;
        
        // Tampilkan box nama file
        fileDisplay.classList.remove('d-none');
        fileDisplay.classList.add('d-inline-block');
        
        // Tambahkan tanda visual pada kotak upload
        uploadLabel.style.borderColor = '#22c55e'; // Hijau
        uploadLabel.style.background = '#f0fdf4'; // Hijau sangat muda
        uploadIcon.className = 'fas fa-check-circle text-success'; // Ubah ikon jadi centang
        
        // Ubah teks instruksi
        const instrText = uploadLabel.querySelector('.fw-bold');
        instrText.textContent = 'Berkas Siap!';
        instrText.classList.remove('text-dark');
        instrText.classList.add('text-success');
    } else {
        fileDisplay.classList.add('d-none');
    }
}
</script>
@endsection