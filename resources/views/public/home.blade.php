@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Global Styles */
    body {
        background-color: #ffffff;
        color: #334155;
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow-x: hidden; /* Mencegah scroll horizontal saat animasi berjalan */
    }

    /* 1. Carousel Hero Section */
    .hero-wrapper {
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        margin-top: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    }

    .carousel-item {
        height: 650px;
        min-height: 500px;
        background-color: #0f172a;
    }

    /* Efek Ken Burns (Zoom Pelan) */
    .carousel-background {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 10s ease-in-out;
        transform: scale(1);
    }

    .active .carousel-background {
        transform: scale(1.15);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(185, 28, 28, 0.75) 100%);
        z-index: 2;
    }

    .hero-content-container {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        color: white;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #f8fafc;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 25px;
    }

    /* 2. Buttons */
    .btn-primary-blue {
        background: #dc2626;
        color: white;
        border: none;
        padding: 16px 42px;
        border-radius: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.4);
    }

    .btn-primary-blue:hover {
        background: #b91c1c;
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -10px rgba(220, 38, 38, 0.5);
        color: white;
    }

    /* 3. Stats Section (Overlapping) */
    .stats-section {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 40px;
        margin: -70px 40px 0 40px;
        position: relative;
        z-index: 30;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }

    .stat-number { 
        font-size: 2.8rem; 
        font-weight: 800; 
        color: #7f1d1d; 
        margin-bottom: 5px;
    }
    
    .stat-label { 
        color: #64748b; 
        font-weight: 600; 
        text-transform: uppercase; 
        letter-spacing: 1.5px; 
        font-size: 0.75rem; 
    }

    /* 4. Feature Cards */
    .feature-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 45px 35px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        border: 1px solid #f1f5f9;
        text-align: center;
    }

    .feature-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px -12px rgba(0,0,0,0.08);
        border-color: #fecaca;
        background: #fffbfb;
    }

    .icon-box {
        width: 75px; height: 75px;
        background: #fef2f2; color: #dc2626;
        display: flex; align-items: center; justify-content: center;
        border-radius: 20px; margin: 0 auto 25px; font-size: 2rem;
        transition: 0.3s ease;
    }

    .feature-card:hover .icon-box {
        background: #dc2626;
        color: white;
        transform: scale(1.1) rotate(5deg);
    }

    /* 5. Section Titles */
    .section-title {
        color: #0f172a;
        font-weight: 800;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: ""; 
        position: absolute;
        bottom: 0; left: 50%;
        transform: translateX(-50%);
        width: 60px; height: 5px;
        background: #dc2626; 
        border-radius: 10px;
    }

    /* 6. CTA Area */
    .cta-area {
        background: #f8fafc;
        border-radius: 32px;
        padding: 80px 40px;
        text-align: center;
        border: 1px solid #f1f5f9;
        margin: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-area::before {
        content: "";
        position: absolute;
        top: -50%; left: -10%;
        width: 400px; height: 400px;
        background: rgba(220, 38, 38, 0.03);
        border-radius: 50%;
        z-index: 0;
    }

    /* ========== MOBILE RESPONSIVE HOME ========== */
    @media (max-width: 768px) {
        .hero-wrapper {
            margin-top: 10px;
            border-radius: 20px;
        }
        
        .carousel-item {
            height: 500px;
            min-height: 400px;
        }
        
        .hero-content-container h1 {
            font-size: 1.75rem !important;
            line-height: 1.3;
        }
        
        .hero-content-container p {
            font-size: 0.95rem !important;
            margin-bottom: 1.5rem !important;
        }
        
        .hero-badge {
            font-size: 0.75rem;
            padding: 6px 15px;
            margin-bottom: 15px;
        }
        
        .btn-primary-blue {
            padding: 12px 24px;
            font-size: 0.9rem;
        }
        
        .stats-section {
            margin: -40px 15px 0 15px;
            padding: 25px 20px;
            border-radius: 18px;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .stat-label {
            font-size: 0.65rem;
        }
        
        .stats-section .border-end {
            border: none !important;
        }
        
        .feature-card {
            padding: 30px 20px;
            border-radius: 20px;
        }
        
        .icon-box {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.5rem !important;
        }
        
        .cta-area {
            padding: 50px 20px;
            border-radius: 20px;
            margin: 40px 0;
        }
        
        .cta-area h2 {
            font-size: 1.4rem !important;
        }
        
        .cta-area p {
            font-size: 0.95rem !important;
        }
    }

    @media (max-width: 480px) {
        .carousel-item {
            height: 450px;
        }
        
        .hero-content-container h1 {
            font-size: 1.5rem !important;
        }
        
        .hero-content-container .d-flex {
            flex-direction: column;
            gap: 0.75rem !important;
        }
        
        .btn-primary-blue, .btn-outline-light {
            width: 100%;
            text-align: center;
        }
        
        .stats-section {
            margin: -30px 10px 0 10px;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container pb-5">

    {{-- HERO SECTION WITH CAROUSEL --}}
    <div class="hero-wrapper" data-aos="zoom-out" data-aos-duration="1200">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators" style="z-index: 11;">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" class="active"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <div class="carousel-background" style="background-image: url('{{ asset('assets/img/serkum.jpg') }}');"></div>
                    <div class="hero-overlay"></div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="carousel-background" style="background-image: url('{{ asset('assets/img/serkum1.jpg') }}');"></div>
                    <div class="hero-overlay"></div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="carousel-background" style="background-image: url('{{ asset('assets/img/serkum2.jpg') }}');"></div>
                    <div class="hero-overlay"></div>
                </div>
            </div>

            <div class="hero-content-container text-center px-3">
                <div style="max-width: 850px;">
                    <span class="hero-badge fw-medium" data-aos="fade-down" data-aos-delay="300">
                        Education Belongs to Every Child
                    </span>
                    <h1 class="display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="500">
                        Sekolah Rakyat <br> Serdadu Kumbang
                    </h1>
                    <p class="fs-5 opacity-90 mb-5 mx-auto" style="max-width: 700px; line-height: 1.8;" data-aos="fade-up" data-aos-delay="700">
                        Sekolah Rakyat Serdadu Kumbang merupakan sebuah Non-Governmental Organization (NGO) yang bergerak di bidang pendidikan dan berfokus pada pengembangan karakter serta pemenuhan hak-hak anak.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="900">
                        <a href="{{ route('pendaftaran') }}" class="btn btn-primary-blue">
                            <i class="fas fa-edit me-2"></i> Mulai Pendaftaran
                        </a>
                        <a href="#tentang" class="btn btn-outline-light px-4 py-3 border-2 rounded-3 fw-semibold transition-all">
                            Pelajari Program
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS SECTION --}}
    <div class="stats-section" data-aos="fade-up" data-aos-delay="200">
        <div class="row g-4 text-center">
            <div class="col-md-4 border-end border-light" data-aos="zoom-in" data-aos-delay="400">
                <p class="stat-number">500+</p>
                <p class="stat-label">Anggota Aktif</p>
            </div>
            <div class="col-md-4 border-end border-light" data-aos="zoom-in" data-aos-delay="600">
                <p class="stat-number">50+</p>
                <p class="stat-label">Pengurus</p>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="800">
                <p class="stat-number">2014</p>
                <p class="stat-label">Tahun Berdiri</p>
            </div>
        </div>
    </div>

    {{-- FEATURES SECTION --}}
    <div class="py-5 mt-5" id="tentang">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title display-5 fw-bold mb-3">Core Values</h2>
            <p class="text-secondary mt-3 fs-5 mx-auto" style="max-width: 650px;">
                Kami berkomitmen memberikan ekosistem yang cerdas dan mandiri.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="fw-bold mb-3">Integrity</h4>
                    <p class="text-secondary leading-relaxed">Integrity adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-bolt"></i></div>
                    <h4 class="fw-bold mb-3">Proactive</h4>
                    <p class="text-secondary leading-relaxed">Proactive adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-handshake"></i></div>
                    <h4 class="fw-bold mb-3">Sense of Belonging</h4>
                    <p class="text-secondary leading-relaxed">Sense of Belonging adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-heart"></i></div>
                    <h4 class="fw-bold mb-3">Dedicated</h4>
                    <p class="text-secondary leading-relaxed">Dedicated adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-dove"></i></div>
                    <h4 class="fw-bold mb-3">Peaceful</h4>
                    <p class="text-secondary leading-relaxed">Peaceful adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card feature-card border-0">
                    <div class="icon-box"><i class="fas fa-rocket"></i></div>
                    <h4 class="fw-bold mb-3">Moving Forward</h4>
                    <p class="text-secondary leading-relaxed">Moving Forward adalah prinsip yang menjadi dasar dari setiap tindakan dan keputusan.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA SECTION --}}
    <div class="cta-area shadow-sm" data-aos="flip-up" data-aos-duration="1000">
        <div class="position-relative z-index-10">
            <h2 class="fw-bold display-6 mb-3 text-dark">Siap Memulai Langkah Berbe?</h2>
            <p class="text-secondary mb-5 fs-5 mx-auto" style="max-width: 700px;">
                Pendaftaran anggota baru sedang dibuka. Bergabunglah sekarang dan jadilah bagian dari keluarga besar SerdaduKumbang.
            </p>
            <a href="{{ route('pendaftaran') }}" class="btn btn-primary-blue btn-lg px-5">
                Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true, // Animasi hanya berjalan sekali saat scroll pertama kali
        duration: 800, // Durasi default animasi (ms)
        easing: 'ease-in-out', // Jenis efek transisi
    });
</script>

@endsection