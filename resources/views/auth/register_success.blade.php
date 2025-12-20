@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
        color: #334155;
    }

    .success-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-card {
        background: white;
        border-radius: 32px;
        padding: 60px 40px;
        box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.1);
        border: 1px solid #f1f5f9;
        max-width: 550px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Blue Circle */
    .success-card::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(37, 99, 235, 0.05);
        border-radius: 50%;
    }

    .icon-box {
        width: 90px;
        height: 90px;
        background: #dcfce7;
        color: #22c55e;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 30px;
        font-size: 3rem;
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    .credential-card {
        background: #f8fafc;
        border: 1.5px dashed #cbd5e1;
        border-radius: 20px;
        padding: 25px;
        margin: 30px 0;
        transition: 0.3s;
    }

    .credential-card:hover {
        border-color: #2563eb;
        background: #f1f7ff;
    }

    .credential-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
        color: #64748b;
        margin-bottom: 5px;
    }

    .credential-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        word-break: break-all;
    }

    .password-display {
        background: white;
        color: #2563eb;
        padding: 10px 15px;
        border-radius: 12px;
        display: inline-block;
        font-family: 'Monaco', 'Consolas', monospace;
        border: 1px solid #e2e8f0;
        margin-top: 10px;
        font-size: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .btn-login-now {
        background: #2563eb;
        color: white;
        padding: 16px 40px;
        border-radius: 16px;
        font-weight: 700;
        border: none;
        width: 100%;
        transition: 0.3s;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        text-decoration: none;
        display: block;
    }

    .btn-login-now:hover {
        background: #1d4ed8;
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
        color: white;
    }

    .warning-note {
        font-size: 0.85rem;
        color: #ef4444;
        background: #fef2f2;
        padding: 12px;
        border-radius: 12px;
        display: inline-block;
        margin-top: 15px;
    }
</style>

<div class="container success-container">
    <div class="success-card text-center" data-aos="zoom-in" data-aos-duration="800">
        <div class="position-relative" style="z-index: 2;">
            <div class="icon-box" data-aos="scale-up" data-aos-delay="400">
                <i class="fas fa-check"></i>
            </div>

            <h2 class="fw-bold text-dark mb-2">Pendaftaran Berhasil!</h2>
            <p class="text-secondary">Ahlan wa Sahlan, <strong>{{ session('name') }}</strong>. Akun Anda telah siap digunakan.</p>

            <div class="credential-card" data-aos="fade-up" data-aos-delay="600">
                <div class="mb-4">
                    <p class="credential-label">Email Anda</p>
                    <p class="credential-value">{{ session('email') }}</p>
                </div>
                
                <div>
                    <p class="credential-label">Password Anda</p>
                    <div class="password-display">
                        {{ session('password') }}
                    </div>
                </div>

                <div class="warning-note">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Password anda tersimpan ke email yang anda daftarkan.
                </div>
            </div>

            <div class="mt-4 pt-2">
                <a href="{{ route('login') }}" class="btn-login-now">
                    Login ke Dashboard <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <p class="mt-4 text-muted small">
                Butuh bantuan? <a href="{{ route('contact') }}" class="text-primary fw-bold text-decoration-none">Hubungi Admin</a>
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: true,
            duration: 1000
        });
    });
</script>
@endsection