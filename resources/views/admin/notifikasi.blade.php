@extends('layouts.app')

@section('title', 'Kirim Notifikasi')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f4f7fa;
    }

    /* Card Styling */
    .notification-card {
        background: white;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header-blue {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        padding: 30px;
        color: white;
    }

    /* Form Styling */
    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    /* Progress Bar Custom */
    .progress {
        height: 12px;
        border-radius: 50px;
        background-color: #e2e8f0;
        margin-top: 10px;
    }

    .progress-bar {
        background: linear-gradient(90deg, #2563eb, #60a5fa);
        border-radius: 50px;
    }

    /* Button Styling */
    .btn-send {
        background: #2563eb;
        color: white;
        padding: 14px 30px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    .btn-send:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-send:disabled {
        background: #94a3b8;
        transform: none;
    }

    /* Info Box */
    .info-box {
        background: #eff6ff;
        border-left: 4px solid #2563eb;
        padding: 15px;
        border-radius: 0 12px 12px 0;
        margin-bottom: 25px;
    }
</style>

<div class="container py-4">
    <div class="mb-4" data-aos="fade-down">
        <h2 class="fw-bold text-dark mb-1">Broadcast Notifikasi</h2>
        <p class="text-secondary mb-0 small">Kirim pesan WhatsApp massal ke pendaftar berdasarkan status mereka.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fs-4 me-3"></i>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="notification-card">
                <div class="card-header-blue text-center">
                    <div class="bg-blue bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                        <i class="fab fa-whatsapp fs-2 text-white"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">Konfigurasi Pesan</h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="info-box d-flex align-items-start gap-3">
                        <i class="fas fa-info-circle text-primary mt-1"></i>
                        <p class="small text-primary fw-medium mb-0">
                            Pastikan format nomor HP pendaftar sudah benar (dimulai dengan 62 atau 08) agar pesan terkirim secara optimal.
                        </p>
                    </div>

                    <form id="notifikasiForm" action="{{ route('admin.kirimNotifikasi') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i> Kelompok Penerima
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="semua">Semua Pendaftar</option>
                                <option value="Menunggu">Status: Menunggu</option>
                                <option value="Lulus">Status: Lulus</option>
                                <option value="Tidak Lulus">Status: Tidak Lulus</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="pesan" class="form-label d-flex align-items-center">
                                <i class="fas fa-comment-alt text-primary me-2"></i> Isi Pesan Notifikasi
                            </label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="6" 
                                      placeholder="Contoh: Assalamualaikum, ..." required></textarea>
                            <div class="form-text mt-2 small">Gunakan bahasa yang sopan dan informatif.</div>
                        </div>

                        <div id="progressContainer" class="mb-4 p-3 border rounded-4 bg-light" style="display:none;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="small fw-bold text-dark m-0">Memproses pengiriman...</label>
                                <span id="progressText" class="small fw-bold text-primary">10%</span>
                            </div>
                            <div class="progress">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                     role="progressbar" style="width: 10%"></div>
                            </div>
                        </div>

                        <button id="btnKirim" type="submit" class="btn-send w-100 mt-2">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Notifikasi Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-4">
                <i class="fas fa-shield-alt me-1"></i> Sistem ini menggunakan API gateway resmi untuk pengiriman pesan.
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true });
    });

    document.getElementById('notifikasiForm').addEventListener('submit', function () {
        document.getElementById('progressContainer').style.display = 'block';

        const btn = document.getElementById('btnKirim');
        const progressText = document.getElementById('progressText');
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Mengirim Antrean...`;

        let progress = 10;
        const bar = document.getElementById('progressBar');

        const loading = setInterval(() => {
            progress += 5;
            if (progress >= 100) progress = 100;
            bar.style.width = progress + "%";
            progressText.innerText = progress + "%";

            if (progress >= 100) {
                clearInterval(loading);
                btn.innerHTML = `<i class="fas fa-sync-alt fa-spin me-2"></i> Sinkronisasi Server...`;
            }
        }, 200);
    });
</script>
@endsection