@extends('layouts.app')
@section('title', 'Riwayat Kegiatan')
@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    .riwayat-header {
        background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(185,28,28,0.8));
        color: white; padding: 40px; border-radius: 24px;
        margin-bottom: 30px; position: relative; overflow: hidden;
    }
    .stat-pill {
        background: rgba(255,255,255,0.12); backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15); padding: 10px 20px;
        border-radius: 14px; text-align: center;
    }
    .stat-pill h4 { font-weight: 800; margin-bottom: 0; }
    .stat-pill small { opacity: 0.8; font-size: 0.75rem; }

    .riwayat-card {
        background: white; border-radius: 16px; padding: 20px;
        border: 1px solid #f1f5f9; box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: all 0.2s; display: flex; align-items: center; gap: 20px;
    }
    .riwayat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(220,38,38,0.08); }
    .riwayat-img {
        width: 80px; height: 80px; border-radius: 14px; object-fit: cover; flex-shrink: 0;
    }
    .riwayat-placeholder {
        width: 80px; height: 80px; border-radius: 14px; flex-shrink: 0;
        background: #fef2f2; display: flex; align-items: center; justify-content: center;
    }
    .riwayat-placeholder i { font-size: 1.5rem; color: #fca5a5; }

    .badge-hadir { background: #d1fae5; color: #065f46; }
    .badge-terdaftar { background: #dbeafe; color: #1e40af; }
    .badge-tidakhadir { background: #fee2e2; color: #991b1b; }

    @media (max-width: 768px) {
        .riwayat-header { padding: 25px 18px; border-radius: 16px; }
        .riwayat-card { flex-direction: column; text-align: center; gap: 12px; }
        .riwayat-img, .riwayat-placeholder { width: 60px; height: 60px; }
    }
</style>

<div class="container py-4">
    <div class="riwayat-header" data-aos="fade-down" data-aos-duration="400">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-white bg-opacity-15 px-3 py-2 rounded-pill mb-2 d-inline-block" style="font-size:0.75rem; font-weight:700; letter-spacing:1px;">
                    <i class="fas fa-history me-1"></i> RIWAYAT
                </span>
                <h2 class="fw-bold mb-1" style="letter-spacing:-0.5px;">Kegiatan Saya</h2>
                <p class="mb-0 opacity-80">Rekap seluruh kegiatan yang pernah kamu ikuti</p>
            </div>
            <div class="d-flex gap-3">
                <div class="stat-pill">
                    <h4>{{ $kegiatans->count() }}</h4>
                    <small>Total Event</small>
                </div>
                <div class="stat-pill">
                    <h4>{{ $kegiatans->where('pivot.status', 'Hadir')->count() }}</h4>
                    <small>Hadir</small>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up" data-aos-duration="400">
        <div class="bg-white px-4 py-3 rounded-4 border shadow-sm d-inline-block">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none text-primary fw-bold">Dashboard</a></li>
                <li class="breadcrumb-item active fw-bold text-secondary">Kegiatan Saya</li>
            </ol>
        </div>
    </nav>

    @if($kegiatans->count())
        <div class="d-flex flex-column gap-3">
            @foreach($kegiatans as $k)
            <div class="riwayat-card" data-aos="fade-up" data-aos-duration="400" data-aos-delay="{{ $loop->index * 50 }}">
                @if($k->gambar)
                    <img src="{{ asset('storage/' . $k->gambar) }}" class="riwayat-img" alt="">
                @else
                    <div class="riwayat-placeholder"><i class="fas fa-calendar-alt"></i></div>
                @endif
                <div class="flex-grow-1">
                    <h6 class="fw-bold mb-1">{{ $k->judul }}</h6>
                    <p class="text-muted small mb-2">
                        <i class="fas fa-calendar me-1"></i>{{ $k->tanggal->format('d M Y') }} &bull;
                        <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($k->lokasi, 30) }}
                    </p>
                    @php
                        $pivotStatus = $k->pivot->status;
                        $badgeClass = match($pivotStatus) {
                            'Hadir' => 'badge-hadir',
                            'Tidak Hadir' => 'badge-tidakhadir',
                            default => 'badge-terdaftar'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1">{{ $pivotStatus }}</span>
                </div>
                <a href="{{ route('kegiatan.show', $k->id) }}" class="btn btn-sm btn-outline-danger rounded-3 px-3 flex-shrink-0">
                    <i class="fas fa-eye me-1"></i>Detail
                </a>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5" data-aos="fade-up">
            <div style="width:80px;height:80px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <i class="fas fa-calendar-times fa-2x" style="color:#94a3b8;"></i>
            </div>
            <h4 class="fw-bold">Belum Ada Riwayat</h4>
            <p class="text-muted mb-4">Kamu belum mengikuti kegiatan apapun. Yuk mulai aksi!</p>
            <a href="{{ route('kegiatan') }}" class="btn btn-danger px-4 rounded-pill">
                <i class="fas fa-search me-2"></i>Cari Kegiatan
            </a>
        </div>
    @endif
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>document.addEventListener('DOMContentLoaded', () => AOS.init({ duration: 400, once: true, easing: 'ease-out' }));</script>
@endsection
