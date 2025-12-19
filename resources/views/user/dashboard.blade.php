@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc; /* Abu-abu sangat muda agar card putih lebih kontras */
        color: #334155;
    }

    /* Header Dashboard Modern */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 64, 175, 0.8) 100%);
        color: white;
        padding: 50px 40px;
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(30, 64, 175, 0.15);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .welcome-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .dashboard-title {
        font-weight: 800;
        font-size: 2.2rem;
        letter-spacing: -1px;
    }

    /* Stats & Info Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(30, 64, 175, 0.08);
    }

    .stat-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 15px;
    }

    /* Status Colors Modernized */
    .status-accepted { border-top: 5px solid #10b981; }
    .status-pending { border-top: 5px solid #3b82f6; }
    .status-rejected { border-top: 5px solid #ef4444; }

    /* Data List Modernization */
    .data-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .data-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 15px;
        transition: 0.3s;
        border: 1px solid transparent;
    }

    .data-item:hover {
        background: #f1f7ff;
        border-color: #dbeafe;
    }

    .data-icon {
        width: 42px;
        height: 42px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 1.1rem;
    }

    /* Badge & Button Custom */
    .status-badge-modern {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .badge-accepted { background: #d1fae5; color: #065f46; }
    .badge-pending { background: #dbeafe; color: #1e40af; }
    .badge-rejected { background: #fee2e2; color: #991b1b; }

    .btn-blue-action {
        background: #2563eb;
        color: white;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    .btn-blue-action:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        color: white;
    }

    /* Empty State Modern */
    .empty-state-card {
        background: white;
        border-radius: 30px;
        padding: 80px 40px;
        text-align: center;
        border: 2px dashed #e2e8f0;
    }

    .empty-icon-circle {
        width: 90px; height: 90px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 25px;
        font-size: 2.5rem;
    }

    /* --- Penyesuaian Responsif Mobile --- */
@media (max-width: 768px) {
    /* Mengurangi padding luar container */
    .container.py-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    /* Penyesuaian Header Dashboard */
    .dashboard-header {
        padding: 35px 25px; /* Padding lebih kecil di HP */
        border-radius: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .dashboard-title {
        font-size: 1.6rem; /* Ukuran font judul lebih kecil */
    }

    /* Menyembunyikan breadcrumb di layar sangat kecil agar tidak penuh */
    nav[aria-label="breadcrumb"] {
        display: none;
    }

    /* Penyesuaian Card Statistik */
    .stat-card {
        padding: 20px;
        text-align: center;
    }
    
    .stat-icon-box {
        margin: 0 auto 10px; /* Ikon ke tengah */
    }

    /* Penyesuaian Kontainer Data Utama */
    .data-card {
        padding: 25px 20px;
        border-radius: 20px;
    }

    /* Penyesuaian Baris Judul dalam Card */
    .data-card .d-flex {
        text-align: center;
        align-items: center !important;
    }

    /* Penyesuaian Data Item agar teks tidak bertumpuk dengan ikon */
    .data-item {
        padding: 12px;
        flex-direction: column; /* Ikon di atas teks pada mobile */
        text-align: center;
    }

    .data-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }

    /* Status Badge Center */
    .status-badge-modern {
        width: 100%;
        justify-content: center;
        margin-top: 10px;
    }

    /* Tombol Lebar Penuh agar mudah ditekan jari */
    .btn-blue-action {
        width: 100%;
        padding: 14px;
    }

    /* Modal penyesuaian untuk layar HP */
    .modal-dialog-centered {
        margin: 10px;
    }
}

/* Memperbaiki jarak Row agar tidak terlalu rapat di mobile */
.row.g-4, .row.g-3 {
    --bs-gutter-y: 1rem;
}
</style>

<div class="container py-4">

    <div class="dashboard-header" data-aos="fade-down">
        <div class="position-relative" style="z-index: 2;">
            <div class="welcome-badge">
                <i class="fas fa-sparkles me-2"></i> Portal Calon Mahasantri
            </div>
            <h1 class="dashboard-title">Ahlan wa Sahlan, {{ Auth::user()->name }}!</h1>
            <p class="mb-0 opacity-90">Pantau perkembangan status pendaftaran Anda secara real-time di sini.</p>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-white px-4 py-3 rounded-4 border border-light shadow-sm d-inline-block">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-primary fw-bold">Beranda</a></li>
                <li class="breadcrumb-item active fw-bold text-secondary">Dashboard</li>
            </ol>
        </div>
    </nav>

    @if ($pendaftaran)
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card status-{{ $pendaftaran->status == 'Diterima' ? 'accepted' : ($pendaftaran->status == 'Ditolak' ? 'rejected' : 'pending') }}">
                    <div class="stat-icon-box {{ $pendaftaran->status == 'Diterima' ? 'badge-accepted' : ($pendaftaran->status == 'Ditolak' ? 'badge-rejected' : 'badge-pending') }}">
                        <i class="fas fa-{{ $pendaftaran->status == 'Diterima' ? 'check' : ($pendaftaran->status == 'Ditolak' ? 'times' : 'clock') }}"></i>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mb-1">Status Verifikasi</p>
                    <h4 class="fw-bold mb-0">{{ $pendaftaran->status ?? 'Menunggu Verifikasi' }}</h4>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card" style="border-top: 5px solid #64748b;">
                    <div class="stat-icon-box bg-light text-secondary">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mb-1">Tanggal Daftar</p>
                    <h4 class="fw-bold mb-0">{{ $pendaftaran->created_at->format('d M Y') }}</h4>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card" style="border-top: 5px solid #f59e0b;">
                    <div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mb-1">Kelengkapan Berkas</p>
                    <h4 class="fw-bold mb-0">Terverifikasi Sistem</h4>
                </div>
            </div>
        </div>

        <div class="data-card mb-5" data-aos="fade-up" data-aos-delay="500">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4 mb-4 pb-4 border-bottom">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Rincian Data Pendaftaran</h3>
                    <p class="text-secondary mb-0 small">Pastikan data di bawah sesuai dengan identitas resmi Anda.</p>
                </div>
                <div class="status-badge-modern {{ $pendaftaran->status == 'Diterima' ? 'badge-accepted' : ($pendaftaran->status == 'Ditolak' ? 'badge-rejected' : 'badge-pending') }}">
                    <span class="dot" style="height:8px; width:8px; border-radius:50%; background:currentColor; display:inline-block"></span>
                    {{ strtoupper($pendaftaran->status ?? 'MENUNGGU VERIFIKASI') }}
                </div>
            </div>

            <div class="row g-3">
                @php
                    $details = [
                        ['icon' => 'id-card', 'label' => 'Nama Lengkap', 'value' => $pendaftaran->nama_lengkap],
                        ['icon' => 'venus-mars', 'label' => 'Jenis Kelamin', 'value' => $pendaftaran->jenis_kelamin],
                        ['icon' => 'envelope', 'label' => 'Email Aktif', 'value' => $pendaftaran->email],
                        ['icon' => 'phone', 'label' => 'Nomor HP/WA', 'value' => $pendaftaran->no_hp],
                        ['icon' => 'map-marker-alt', 'label' => 'Alamat Domisili', 'value' => $pendaftaran->alamat],
                    ];
                @endphp

                @foreach($details as $detail)
                <div class="col-md-6">
                    <div class="data-item">
                        <div class="data-icon"><i class="fas fa-{{ $detail['icon'] }}"></i></div>
                        <div>
                            <p class="text-muted small fw-bold mb-0 text-uppercase letter-spacing-1">{{ $detail['label'] }}</p>
                            <span class="fw-bold text-dark">{{ $detail['value'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5 pt-4 border-top">
                <button type="button" class="btn btn-blue-action px-5" data-bs-toggle="modal" data-bs-target="#modalBerkasUser">
                    <i class="fas fa-file-pdf me-2"></i> Pratinjau Berkas Saya
                </button>
            </div>
        </div>

    @else
        <div class="empty-state-card" data-aos="zoom-in">
            <div class="empty-icon-circle">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h2 class="fw-bold text-dark">Belum Ada Data Pendaftaran</h2>
            <p class="text-secondary mx-auto mb-5" style="max-width: 500px;">
                Anda belum mengisi formulir pendaftaran. Silakan tekan tombol di bawah untuk memulai proses pendaftaran santri baru.
            </p>
            <a href="{{ route('pendaftaran') }}" class="btn btn-blue-action py-3 px-5 rounded-pill shadow-lg">
                Mulai Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    @endif

</div>

@if($pendaftaran)
<div class="modal fade" id="modalBerkasUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content overflow-hidden" style="border-radius: 25px;">
            <div class="modal-header border-0 bg-primary text-white p-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-file-alt me-2"></i>Preview Dokumen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 bg-light" style="height: 75vh;">
                @php $ext = strtolower(pathinfo($pendaftaran->berkas, PATHINFO_EXTENSION)); @endphp
                @if($ext === 'pdf')
                    <iframe src="{{ asset('storage/' . $pendaftaran->berkas) }}" width="100%" height="100%" class="border-0"></iframe>
                @elseif(in_array($ext, ['jpg','jpeg','png']))
                    <div class="h-100 d-flex align-items-center justify-content-center p-4">
                        <img src="{{ asset('storage/' . $pendaftaran->berkas) }}" class="img-fluid rounded shadow-sm" style="max-height: 100%;">
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-file-download fa-4x text-muted mb-3"></i>
                        <p>Format file tidak didukung untuk pratinjau. Silakan unduh file.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer border-0 p-4">
                <a href="{{ asset('storage/' . $pendaftaran->berkas) }}" target="_blank" class="btn btn-primary fw-bold px-4 rounded-pill">
                    <i class="fas fa-external-link-alt me-2"></i> Buka Fullscreen
                </a>
                <button type="button" class="btn btn-light fw-bold px-4 rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>
@endsection