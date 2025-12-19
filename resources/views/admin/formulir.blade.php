@extends('layouts.app')

@section('title', 'Status Formulir Pendaftaran')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f4f7fa;
    }

    /* Status Card Styling */
    .status-card {
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

    /* Badge Status Modern */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .indicator-open {
        background: rgba(34, 197, 94, 0.15);
        color: #16a34a;
    }

    .indicator-closed {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
    }

    /* Form Design */
    .form-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .form-control:disabled {
        background-color: #f1f5f9;
        color: #64748b;
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-save {
        background: #2563eb;
        color: white;
        padding: 14px 30px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    .btn-save:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
        color: white;
    }

    /* Illustration Icon */
    .icon-circle {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
</style>

<div class="container py-5">
    <div class="mb-5 text-center text-md-start" data-aos="fade-down">
        <h2 class="fw-bold text-dark mb-1">Konfigurasi Periode</h2>
        <p class="text-secondary mb-0">Kelola jadwal buka dan tutup formulir pendaftaran santri secara otomatis.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4 d-flex align-items-center" data-aos="zoom-in">
            <i class="fas fa-check-circle fs-4 me-3"></i>
            <div class="fw-bold">{{ session('success') }}</div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-7" data-aos="fade-up">
            <div class="status-card">
                <div class="card-header-blue text-center">
                    <div class="icon-circle">
                        <i class="fas fa-calendar-check fs-2 text-white"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">Pengaturan Formulir</h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.updateStatusForm') }}" method="POST">
                        @csrf

                        <div class="mb-5 text-center">
                            <label class="form-label d-block mb-3">Status Pendaftaran Saat Ini</label>
                            @php 
                                $isOpen = strtolower($statusForm->status) == 'buka';
                            @endphp
                            <div class="status-indicator {{ $isOpen ? 'indicator-open' : 'indicator-closed' }}">
                                <i class="fas {{ $isOpen ? 'fa-door-open' : 'fa-door-closed' }} me-2"></i>
                                {{ strtoupper($statusForm->status) }}
                            </div>
                            <input type="hidden" class="form-control" value="{{ $statusForm->status }}" disabled>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i> Tanggal Buka
                                </label>
                                <input type="date" name="tanggal_buka" class="form-control shadow-sm"
                                       value="{{ $statusForm->tanggal_buka }}">
                                <div class="form-text mt-2 small">Formulir akan muncul otomatis.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-flex align-items-center">
                                    <i class="fas fa-hand-paper text-danger me-2"></i> Tanggal Tutup
                                </label>
                                <input type="date" name="tanggal_tutup" class="form-control shadow-sm"
                                       value="{{ $statusForm->tanggal_tutup }}">
                                <div class="form-text mt-2 small">Pendaftaran akan dikunci otomatis.</div>
                            </div>
                        </div>

                        <hr class="my-5 opacity-50">

                        <div class="text-center">
                            <button type="submit" class="btn-save px-5 w-100 w-md-auto">
                                <i class="fas fa-save me-2"></i> Perbarui Periode Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-4">
                <i class="fas fa-info-circle me-1"></i> Perubahan jadwal akan langsung berdampak pada akses halaman pendaftaran bagi calon santri.
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-out-back',
            once: true
        });
    });
</script>
@endsection