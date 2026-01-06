@extends('layouts.app')

@section('title', 'Informasi Pendaftaran')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #ffffff;
        color: #334155;
        overflow-x: hidden;
    }

    /* Hero Section Modernization - Tanpa Background Image */
    .info-hero {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(185, 28, 28, 0.75) 100%);
        color: white;
        padding: 100px 20px;
        border-radius: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(220, 38, 38, 0.15);
        margin-bottom: 40px;
    }

    .info-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
    }

    /* Info Cards - Disesuaikan Lebarnya agar sama dengan Hero */
    .info-card {
        background: white;
        border-radius: 28px;
        padding: 45px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%; /* Memastikan lebar penuh container */
    }

    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(220, 38, 38, 0.1);
        border-color: #fecaca;
    }

    .info-card::before {
        content: "";
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 8px;
        background: #dc2626;
    }

    .info-title {
        color: #7f1d1d;
        font-weight: 800;
        font-size: 1.85rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .info-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #64748b;
        margin-bottom: 30px;
    }

    /* Meta & Buttons */
    .info-meta {
        background: #f8fafc;
        padding: 12px 24px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #f1f5f9;
    }

    .info-meta-icon {
        color: #dc2626;
        font-size: 1.2rem;
    }

    .btn-blue-primary {
        background: #dc2626;
        color: white;
        padding: 14px 36px;
        border-radius: 14px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px rgba(220, 38, 38, 0.4);
    }

    .btn-blue-primary:hover {
        background: #b91c1c;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -5px rgba(220, 38, 38, 0.5);
        color: white;
    }

    .empty-state {
        background: #f8faff;
        border: 2px dashed #fecaca;
        border-radius: 32px;
        padding: 80px 40px;
        text-align: center;
    }

    .empty-icon-circle {
        width: 100px; height: 100px;
        background: #eff6ff;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 30px;
        font-size: 3rem;
    }

    .bg-decoration {
        position: absolute;
        z-index: 0;
        opacity: 0.05;
        pointer-events: none;
    }
</style>

<div class="container py-4">
    {{-- HERO SECTION --}}
    <div class="info-hero text-center" data-aos="zoom-out" data-aos-duration="1000">
        <div class="position-relative" style="z-index: 2;">
            <div class="info-badge" data-aos="fade-down" data-aos-delay="400">
                <i class="fas fa-info-circle me-2"></i> Update Informasi SerdaduKumbang
            </div>
            <h1 class="fw-bold display-4" data-aos="fade-up" data-aos-delay="600">Update Informasi</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="800">
                Simak informasi terbaru mengenai jadwal seleksi, persyaratan dokumen, dan kegiatan resmi SerdaduKumbang secara berkala.
            </p>
            
            {{-- CATEGORY FILTER TABS --}}
            <div class="d-flex justify-content-center gap-2 mt-4 flex-wrap" data-aos="fade-up" data-aos-delay="900">
                @php
                    $categories = ['Semua', 'Pendaftaran', 'Kegiatan', 'Lainnya'];
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('informasi', ['kategori' => $cat]) }}" 
                       class="btn {{ ($selectedKategori ?? 'Semua') == $cat ? 'btn-light text-danger fw-bold' : 'btn-outline-light' }} rounded-pill px-4 py-2">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CONTENT SECTION - Tanpa bungkus Row/Col agar lebarnya mengikuti container (sama dengan Hero) --}}
    <div class="pb-5">
        @if ($informasi->count())
            @foreach ($informasi as $index => $item)
                <div class="info-card mb-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                    <i class="fas fa-quote-right bg-decoration" style="top: 20px; right: 20px; font-size: 8rem;"></i>
                    
                    <div class="position-relative" style="z-index: 1;">
                        <span class="badge bg-danger mb-2">{{ $item->kategori }}</span>
                        <h3 class="info-title">{{ $item->judul }}</h3>
                        
                        <div class="info-content">
                            {!! nl2br(e($item->isi)) !!}
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4 mt-4">
                            <div class="info-meta">
                                <i class="fas fa-calendar-alt info-meta-icon"></i>
                                <span class="text-muted small fw-bold">
                                    Rilis: {{ $item->updated_at->format('d F Y') }} • {{ $item->updated_at->format('H:i') }} WIB
                                </span>
                            </div>

                            @if($item->kategori == 'Kegiatan' || $item->kategori == 'Lainnya')
                                <a href="{{ route('informasi.show', $item->id) }}" class="btn btn-blue-primary">
                                    <i class="fas fa-eye me-2"></i> Lihat Detail
                                </a>
                            @else
                                <a href="{{ route('pendaftaran') }}" class="btn btn-blue-primary">
                                    <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-icon-circle">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="fw-bold text-dark">Belum Ada Informasi</h3>
                <p class="text-secondary mx-auto mb-4" style="max-width: 500px;">
                    Saat ini pengumuman pendaftaran belum tersedia. Tim admin kami sedang mempersiapkan update terbaru untuk Anda.
                </p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-bold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        @endif
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
</script>

@endsection