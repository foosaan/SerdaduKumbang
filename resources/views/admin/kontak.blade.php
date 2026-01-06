@extends('layouts.app')

@section('title', 'Kelola Kontak')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f4f7fa;
    }

    /* Card Styling */
    .contact-card {
        background: white;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header-blue {
        background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
        padding: 30px;
        color: white;
        text-align: center;
    }

    /* Form Design */
    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group-custom i {
        position: absolute;
        left: 15px;
        color: #dc2626;
        z-index: 10;
        font-size: 1.1rem;
    }

    .form-control-custom {
        border-radius: 12px !important;
        padding: 12px 16px 12px 45px !important;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-custom:focus {
        background-color: #ffffff;
        border-color: #dc2626;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        outline: none;
    }

    /* Button Styling */
    .btn-save {
        background: #dc2626;
        color: white;
        padding: 14px 30px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
        width: 100%;
    }

    .btn-save:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(220, 38, 38, 0.4);
        color: white;
    }

    .icon-bg {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
</style>

<div class="container py-5">
    <div class="mb-4 text-center text-md-start" data-aos="fade-down">
        <h2 class="fw-bold text-dark mb-1">Pengaturan Kontak</h2>
        <p class="text-secondary mb-0 small">Informasi ini akan ditampilkan pada halaman "Kontak Kami" bagi pengunjung.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4 d-flex align-items-center" data-aos="zoom-in">
            <i class="fas fa-check-circle fs-4 me-3"></i>
            <div class="fw-bold">{{ session('success') }}</div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-7" data-aos="fade-up">
            <div class="contact-card">
                <div class="card-header-blue">
                    <div class="icon-bg">
                        <i class="fas fa-address-book fs-3 text-white"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">Update Informasi Kontak</h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.kontak.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Alamat Instansi</label>
                            <div class="input-group-custom">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" name="alamat" class="form-control-custom" 
                                       value="{{ $kontak->alamat }}" placeholder="Jl. Contoh No. 123..." required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nomor Telepon / WhatsApp</label>
                            <div class="input-group-custom">
                                <i class="fas fa-phone-alt"></i>
                                <input type="text" name="telepon" class="form-control-custom" 
                                       value="{{ $kontak->telepon }}" placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Email Resmi</label>
                            <div class="input-group-custom">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control-custom" 
                                       value="{{ $kontak->email }}" placeholder="info@instansi.sch.id" required>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-save shadow-sm">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light border px-4 py-3 rounded-4 fw-bold text-secondary text-decoration-none">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-4">
                <i class="fas fa-shield-alt me-1"></i> Data kontak ini tersinkronisasi secara otomatis ke seluruh bagian website.
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true
        });
    });
</script>
@endsection