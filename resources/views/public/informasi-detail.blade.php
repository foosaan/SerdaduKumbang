@extends('layouts.app')

@section('title', $informasi->judul)

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #f8fafc;
    }

    .detail-hero {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(185, 28, 28, 0.75) 100%);
        color: white;
        padding: 60px 20px;
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .detail-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .poster-wrapper {
        max-width: 900px;
        margin: 0 auto 40px;
        text-align: center;
    }

    .poster-img {
        max-width: 100%;
        max-height: 600px;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .badge-kategori {
        background: #dc2626;
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .content-text {
        font-size: 1.1rem;
        line-height: 2;
        color: #475569;
        max-width: 800px;
        margin: 0 auto;
    }

    .btn-back {
        background: #dc2626;
        color: white;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: #b91c1c;
        color: white;
        transform: translateY(-2px);
    }

    /* ========== MOBILE RESPONSIVE ========== */
    @media (max-width: 768px) {
        .detail-hero {
            padding: 30px 15px;
            border-radius: 16px;
            margin-bottom: 15px;
        }
        
        .detail-hero h1 {
            font-size: 1.1rem !important;
        }
        
        .detail-hero p {
            font-size: 0.7rem !important;
        }
        
        .badge-kategori {
            padding: 5px 14px;
            font-size: 0.65rem;
        }
        
        .detail-card {
            padding: 20px 16px;
            border-radius: 16px;
        }
        
        .poster-wrapper {
            margin: 0 auto 20px;
        }
        
        .poster-img {
            max-height: 300px;
            border-radius: 12px;
        }
        
        .content-text {
            font-size: 0.8rem;
            line-height: 1.6;
        }
        
        .btn-back {
            padding: 10px 20px;
            font-size: 0.75rem;
            border-radius: 10px;
        }
        
        .gallery-section h4 {
            font-size: 0.9rem !important;
        }
        
        .gallery-img {
            height: 120px !important;
        }
    }

    @media (max-width: 480px) {
        .detail-hero {
            padding: 25px 12px;
            border-radius: 14px;
        }
        
        .detail-hero h1 {
            font-size: 1rem !important;
        }
        
        .detail-hero p {
            font-size: 0.65rem !important;
        }
        
        .badge-kategori {
            padding: 4px 12px;
            font-size: 0.6rem;
        }
        
        .detail-card {
            padding: 16px 14px;
        }
        
        .poster-img {
            max-height: 200px;
        }
        
        .content-text {
            font-size: 0.75rem;
        }
        
        .btn-back {
            padding: 8px 16px;
            font-size: 0.7rem;
            width: 100%;
            text-align: center;
        }
        
        .gallery-section h4 {
            font-size: 0.8rem !important;
        }
        
        .gallery-img {
            height: 100px !important;
        }
    }

    @media (max-width: 375px) {
        .detail-hero h1 {
            font-size: 0.9rem !important;
        }
        
        .content-text {
            font-size: 0.7rem;
        }
    }
</style>

<div class="container py-4">
    {{-- HERO --}}
    <div class="detail-hero text-center" data-aos="zoom-out">
        <span class="badge-kategori mb-3 d-inline-block">{{ $informasi->kategori }}</span>
        <h1 class="fw-bold display-5">{{ $informasi->judul }}</h1>
        <p class="opacity-75 mb-0">
            <i class="fas fa-calendar-alt me-2"></i>
            {{ $informasi->updated_at->format('d F Y') }} • {{ $informasi->updated_at->format('H:i') }} WIB
        </p>
    </div>

    {{-- CONTENT --}}
    <div class="detail-card" data-aos="fade-up">
        @if($informasi->gambar)
            <div class="poster-wrapper">
                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="poster-img">
            </div>
        @endif

        <div class="content-text">
            {!! nl2br(e($informasi->isi)) !!}
        </div>

        @if($informasi->galeri && count($informasi->galeri) > 0)
        <div class="gallery-section mt-5">
            <h4 class="fw-bold text-dark mb-4"><i class="fas fa-images me-2 text-danger"></i>Galeri Kegiatan</h4>
            <div class="row g-3">
                @foreach($informasi->galeri as $foto)
                <div class="col-6 col-md-4">
                    <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                        <img src="{{ asset('storage/' . $foto) }}" alt="Gallery" class="gallery-img w-100 rounded-3" style="height: 200px; object-fit: cover; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <a href="{{ route('informasi') }}" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Informasi
            </a>

            @if($informasi->kategori == 'Pendaftaran')
                <a href="{{ route('pendaftaran') }}" class="btn btn-back">
                    <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
                </a>
            @endif
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>

@endsection
