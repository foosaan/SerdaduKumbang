@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: var(--bg-body, #f8fafc);
        color: var(--text-body, #334155);
    }

    /* Header Dashboard Modern */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(185, 28, 28, 0.8) 100%);
        color: white;
        padding: 50px 40px;
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(185, 28, 28, 0.15);
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
        background: var(--bg-card, white);
        border-radius: 20px;
        padding: 25px;
        border: 1px solid var(--border-color, #f1f5f9);
        box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(185, 28, 28, 0.08);
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
    .status-pending { border-top: 5px solid #dc2626; }
    .status-rejected { border-top: 5px solid #ef4444; }

    /* Data List Modernization */
    .data-card {
        background: var(--bg-card, white);
        border-radius: 24px;
        padding: 40px;
        border: 1px solid var(--border-color, #f1f5f9);
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
        background: var(--bg-muted, #fff1f1);
        border-color: var(--border-color, #fecaca);
    }

    .data-icon {
        width: 42px;
        height: 42px;
        background: var(--bg-muted, #fef2f2);
        color: #dc2626;
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
        background: #dc2626;
        color: white;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
    }

    .btn-blue-action:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        color: white;
    }

    /* Empty State Modern */
    .empty-state-card {
        background: var(--bg-card, white);
        border-radius: 30px;
        padding: 80px 40px;
        text-align: center;
        border: 2px dashed var(--border-color, #e2e8f0);
    }

    .empty-icon-circle {
        width: 90px; height: 90px;
        background: var(--bg-muted, #f1f5f9);
        color: var(--text-muted, #94a3b8);
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
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
    }

    /* Penyesuaian Header Dashboard */
    .dashboard-header {
        padding: 25px 18px;
        border-radius: 16px;
        margin-bottom: 15px;
        text-align: center;
    }

    .welcome-badge {
        font-size: 0.6rem;
        padding: 4px 12px;
        margin-bottom: 10px;
    }

    .dashboard-title {
        font-size: 1.2rem;
        letter-spacing: 0;
    }

    .dashboard-header p {
        font-size: 0.75rem;
        line-height: 1.4;
    }

    /* Menyembunyikan breadcrumb di layar sangat kecil agar tidak penuh */
    nav[aria-label="breadcrumb"] {
        display: none;
    }

    /* Penyesuaian Card Statistik */
    .stat-card {
        padding: 15px 12px;
        text-align: center;
        border-radius: 14px;
    }
    
    .stat-icon-box {
        margin: 0 auto 8px;
        width: 40px;
        height: 40px;
        font-size: 1rem;
        border-radius: 10px;
    }

    .stat-card p.text-muted {
        font-size: 0.6rem !important;
        margin-bottom: 2px !important;
    }

    .stat-card h4 {
        font-size: 0.85rem !important;
    }

    /* Penyesuaian Kontainer Data Utama */
    .data-card {
        padding: 18px 15px;
        border-radius: 16px;
    }

    .data-card h3 {
        font-size: 1rem !important;
    }

    .data-card p.small {
        font-size: 0.7rem !important;
    }

    /* Penyesuaian Data Item agar teks tidak bertumpuk dengan ikon */
    .data-item {
        padding: 10px 8px;
        flex-direction: row;
        text-align: left;
        border-radius: 12px;
    }

    .data-icon {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
        margin-right: 12px;
        margin-bottom: 0;
        border-radius: 8px;
    }

    .data-item .text-muted {
        font-size: 0.55rem !important;
    }

    .data-item .fw-bold {
        font-size: 0.75rem !important;
    }

    /* Status Badge */
    .status-badge-modern {
        padding: 5px 12px;
        font-size: 0.65rem;
        margin-top: 10px;
    }

    /* Tombol */
    .btn-blue-action {
        width: 100%;
        padding: 12px;
        font-size: 0.8rem;
        border-radius: 10px;
    }

    /* Empty State */
    .empty-state-card {
        padding: 40px 20px;
        border-radius: 20px;
    }

    .empty-icon-circle {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .empty-state-card h2 {
        font-size: 1.1rem !important;
    }

    .empty-state-card p {
        font-size: 0.75rem !important;
    }

    /* Modal penyesuaian untuk layar HP */
    .modal-dialog-centered {
        margin: 10px;
    }

    .modal-body {
        height: 60vh !important;
    }
}

@media (max-width: 480px) {
    .container.py-4 {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .dashboard-header {
        padding: 20px 15px;
        border-radius: 14px;
    }

    .welcome-badge {
        font-size: 0.55rem;
        padding: 3px 10px;
    }

    .dashboard-title {
        font-size: 1rem;
    }

    .dashboard-header p {
        font-size: 0.7rem;
    }

    .stat-card {
        padding: 12px 10px;
    }

    .stat-icon-box {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }

    .stat-card p.text-muted {
        font-size: 0.55rem !important;
    }

    .stat-card h4 {
        font-size: 0.75rem !important;
    }

    .data-card {
        padding: 15px 12px;
    }

    .data-card h3 {
        font-size: 0.9rem !important;
    }

    .data-icon {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
        margin-right: 10px;
    }

    .data-item .text-muted {
        font-size: 0.5rem !important;
    }

    .data-item .fw-bold {
        font-size: 0.7rem !important;
    }

    .status-badge-modern {
        padding: 4px 10px;
        font-size: 0.6rem;
    }

    .btn-blue-action {
        padding: 10px;
        font-size: 0.75rem;
    }

    .empty-state-card {
        padding: 30px 15px;
    }

    .empty-icon-circle {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }

    .empty-state-card h2 {
        font-size: 1rem !important;
    }

    .empty-state-card p {
        font-size: 0.7rem !important;
    }
}

@media (max-width: 375px) {
    .dashboard-header {
        padding: 18px 12px;
    }

    .dashboard-title {
        font-size: 0.9rem;
    }

    .dashboard-header p {
        font-size: 0.65rem;
    }

    .stat-card h4 {
        font-size: 0.7rem !important;
    }

    .data-card h3 {
        font-size: 0.85rem !important;
    }

    .data-item .fw-bold {
        font-size: 0.65rem !important;
    }
}

/* Memperbaiki jarak Row agar tidak terlalu rapat di mobile */
.row.g-4, .row.g-3 {
    --bs-gutter-y: 0.75rem;
}

/* ===== DARK MODE (dashboard-specific) ===== */
html.dark .stat-card {
    background: var(--bg-card);
    border-color: var(--border-color);
}

html.dark .stat-card:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
}

html.dark .data-card {
    background: var(--bg-card);
    border-color: var(--border-color);
}

html.dark .data-item:hover {
    background: var(--bg-muted);
    border-color: var(--border-color);
}

html.dark .data-icon {
    background: var(--bg-muted);
    color: #f87171;
}

html.dark .empty-state-card {
    background: var(--bg-card);
    border-color: var(--border-color);
}

html.dark .empty-icon-circle {
    background: var(--bg-muted);
    color: var(--text-muted);
}
</style>

<div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 p-3 mb-4" data-aos="zoom-in">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="dashboard-header" data-aos="fade-down">
        <div class="position-relative" style="z-index: 2;">
            <div class="welcome-badge">
                <i class="fas fa-sparkles me-2"></i> Portal Calon SerdaduKumbang
            </div>
            <h1 class="dashboard-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
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

            @if($pendaftaran->status == 'Tidak Lulus' && $pendaftaran->alasan)
            <div class="mt-4 p-4 rounded-4" style="background: #fef2f2; border: 1px solid #fecaca;" data-aos="fade-up" data-aos-delay="600">
                <h6 class="fw-bold text-danger mb-2"><i class="fas fa-info-circle me-2"></i>Keterangan dari Admin</h6>
                <p class="mb-0 text-dark">{{ $pendaftaran->alasan }}</p>
            </div>
            @endif

            <div class="mt-5 pt-4 border-top d-flex flex-wrap gap-3">
                <button type="button" class="btn btn-blue-action px-5" data-bs-toggle="modal" data-bs-target="#modalBerkasUser">
                    <i class="fas fa-file-pdf me-2"></i> Pratinjau Berkas Saya
                </button>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary px-4" style="border-radius: 12px; font-weight: 700;">
                    <i class="fas fa-key me-2"></i> Ganti Password
                </a>
            </div>
        </div>

    @else
        <div class="empty-state-card" data-aos="zoom-in">
            <div class="empty-icon-circle">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h2 class="fw-bold text-dark">Belum Ada Data Pendaftaran</h2>
            <p class="text-secondary mx-auto mb-5" style="max-width: 500px;">
                Anda belum mengisi formulir pendaftaran. Silakan tekan tombol di bawah untuk memulai proses pendaftaran baru.
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
            <div class="modal-body p-0">
                @php
                    $dokumen = collect([
                        ['label' => 'CV', 'icon' => 'fa-file-pdf', 'file' => $pendaftaran->cv],
                        ['label' => 'Follow Instagram', 'icon' => 'fa-instagram', 'file' => $pendaftaran->follow_ig],
                        ['label' => 'Follow TikTok', 'icon' => 'fa-music', 'file' => $pendaftaran->follow_tiktok],
                        ['label' => 'Portofolio', 'icon' => 'fa-briefcase', 'file' => $pendaftaran->portofolio],
                        ['label' => 'Berkas Lainnya', 'icon' => 'fa-paperclip', 'file' => $pendaftaran->berkas],
                    ])->filter(fn($d) => !empty($d['file']));
                @endphp

                @if($dokumen->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <p class="text-muted fw-semibold">Belum ada dokumen yang diunggah.</p>
                    </div>
                @else
                    {{-- Tab Navigation --}}
                    <ul class="nav nav-tabs px-4 pt-3" id="berkasTab" role="tablist">
                        @foreach($dokumen->values() as $i => $doc)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $i === 0 ? 'active' : '' }} fw-semibold" 
                                    id="berkas-tab-{{ $i }}" data-bs-toggle="tab" 
                                    data-bs-target="#berkas-pane-{{ $i }}" type="button" role="tab">
                                <i class="fas {{ $doc['icon'] }} me-1"></i> {{ $doc['label'] }}
                            </button>
                        </li>
                        @endforeach
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content" id="berkasTabContent">
                        @foreach($dokumen->values() as $i => $doc)
                        <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" 
                             id="berkas-pane-{{ $i }}" role="tabpanel" style="height: 65vh;">
                            @php $ext = strtolower(pathinfo($doc['file'], PATHINFO_EXTENSION)); @endphp
                            @if($ext === 'pdf')
                                <iframe src="{{ asset('storage/' . $doc['file']) }}" width="100%" height="100%" class="border-0"></iframe>
                            @elseif(in_array($ext, ['jpg','jpeg','png','webp']))
                                <div class="h-100 d-flex align-items-center justify-content-center p-4 bg-light">
                                    <img src="{{ asset('storage/' . $doc['file']) }}" class="img-fluid rounded shadow-sm" style="max-height: 100%; object-fit: contain;">
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-file-download fa-4x text-muted mb-3"></i>
                                    <p>Format file tidak didukung untuk pratinjau.</p>
                                    <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                                        <i class="fas fa-download me-2"></i>Unduh File
                                    </a>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="modal-footer border-0 p-4">
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