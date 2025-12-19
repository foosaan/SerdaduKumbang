@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background-color: #fcfdfe;
        color: #334155;
        overflow-x: hidden;
    }

    /* Hero Section Tanpa Gambar - Selaras dengan desain Informasi & Pendaftaran */
    .contact-hero {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 64, 175, 0.75) 100%),
                    radial-gradient(at 100% 100%, rgba(29, 78, 216, 0.1) 0, transparent 50%),
                    #ffffff;
        padding: 80px 20px;
        border-radius: 40px;
        position: relative;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-bottom: 50px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Ornamen Geometris Halus */
    .hero-circle {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        filter: blur(80px);
        opacity: 0.07;
        z-index: 0;
    }

    .contact-badge {
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

    .hero-title {
        color: white;
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -1px;
    }

    /* Contact Cards */
    .contact-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .contact-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px -12px rgba(37, 99, 235, 0.15);
        border-color: #dbeafe;
    }

    .contact-card::after {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 6px;
        background: #2563eb;
        opacity: 0;
        transition: 0.3s;
    }

    .contact-card:hover::after {
        opacity: 1;
    }

    .contact-icon-wrapper {
        width: 70px;
        height: 70px;
        margin: 0 auto 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 1.8rem;
        transition: 0.5s ease;
    }

    .icon-primary { background: #eff6ff; color: #2563eb; }
    .icon-success { background: #f0fdf4; color: #16a34a; }
    .icon-warning { background: #fffbeb; color: #d97706; }

    .contact-card:hover .contact-icon-wrapper {
        transform: scale(1.1) rotate(10deg);
        background: #2563eb;
        color: white;
    }

    /* Map Section */
    .map-container {
        background: white;
        border-radius: 32px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9;
        margin-top: 60px;
    }

    .map-embed {
        width: 100%;
        height: 450px;
        border-radius: 24px;
        border: none;
        filter: grayscale(10%) contrast(100%);
    }

    /* Social Links */
    .social-links {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }

    .social-link {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        transition: 0.3s;
        text-decoration: none;
    }

    .social-link:hover {
        transform: translateY(-5px) rotate(8deg);
        filter: brightness(1.1);
    }

    .social-whatsapp { background: #25D366; }
    .social-instagram { background: linear-gradient(45deg, #f09433, #dc2743, #bc1888); }
    .social-facebook { background: #1877F2; }
    .social-email { background: #EA4335; }

    /* CTA Section */
    .cta-section {
        background: #f8fafc;
        border-radius: 32px;
        padding: 60px 40px;
        text-align: center;
        border: 1px solid #f1f5f9;
        margin-top: 80px;
    }

    .btn-blue-cta {
        background: #2563eb;
        color: white;
        padding: 16px 48px;
        border-radius: 18px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        transition: 0.3s;
    }

    .btn-blue-cta:hover {
        background: #1d4ed8;
        transform: scale(1.05);
        color: white;
    }
</style>

<div class="container-fluid px-0">

    <div class="container py-4">
        <div class="contact-hero text-center" data-aos="fade-down">
            <div class="hero-circle" style="width: 300px; height: 300px; top: -100px; left: -100px;"></div>
            <div class="hero-circle" style="width: 200px; height: 200px; bottom: -50px; right: -50px;"></div>

            <div class="hero-content position-relative" style="z-index: 2;">
                <div class="contact-badge" data-aos="zoom-in" data-aos-delay="300">
                    <i class="fas fa-headset me-2"></i> Layanan Informasi
                </div>
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="500">Hubungi Kami</h1>
                <p class="lead text-white mt-3 px-md-5 mx-auto" style="max-width: 750px;" data-aos="fade-up" data-aos-delay="700">
                    Punya pertanyaan mengenai pendaftaran atau program Rumah TahfidzQu? Tim kami siap membantu Anda dengan ramah dan cepat.
                </p>
            </div>
        </div>
    </div>

    <div class="container pb-5">

        @if($kontak)
            <div class="row g-4 mb-5">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-card">
                        <div class="contact-icon-wrapper icon-primary">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Lokasi PPTQ</h4>
                        <p class="text-center text-secondary mb-0 px-2" style="line-height: 1.8;">
                            {{ $kontak->alamat }}
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-card">
                        <div class="contact-icon-wrapper icon-success">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Telepon / WA</h4>
                        <div class="text-center">
                            <a href="tel:{{ $kontak->telepon }}" class="text-decoration-none h5 fw-bold text-dark d-block mb-1">
                                {{ $kontak->telepon }}
                            </a>
                            <small class="text-muted text-uppercase fw-bold letter-spacing-1" style="font-size: 0.7rem;">
                                Aktif: 08:00 - 16:00 WIB
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="contact-card">
                        <div class="contact-icon-wrapper icon-warning">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h4 class="text-center fw-bold mb-3">Email Resmi</h4>
                        <div class="text-center">
                            <a href="mailto:{{ $kontak->email }}" class="text-decoration-none h5 fw-bold text-dark d-block mb-1">
                                {{ $kontak->email }}
                            </a>
                            <small class="text-muted text-uppercase fw-bold letter-spacing-1" style="font-size: 0.7rem;">
                                Balasan dalam 24 jam
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mb-5 py-4" data-aos="zoom-in">
                <h4 class="fw-bold mb-4">Temukan Kami di Media Sosial</h4>
                <div class="social-links">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->telepon) }}" class="social-link social-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="social-link social-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link social-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="mailto:{{ $kontak->email }}" class="social-link social-email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>

            <div class="map-container" data-aos="fade-up">
                <div class="text-center mb-4">
                    <h3 class="fw-bold"><i class="fas fa-directions text-primary me-2"></i>Panduan Lokasi</h3>
                    <p class="text-secondary small">Navigasi langsung menggunakan Google Maps</p>
                </div>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v123456789" 
                    class="map-embed" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>

        @else
            <div class="text-center py-5" data-aos="fade-up">
                <i class="fas fa-comment-slash text-muted mb-4" style="font-size: 5rem; opacity: 0.2;"></i>
                <h3 class="fw-bold">Informasi Kontak Belum Tersedia</h3>
                <p class="text-secondary mb-5">Data kontak sedang dalam pemeliharaan. Silakan kembali lagi nanti.</p>
                <a href="{{ route('home') }}" class="btn-blue-cta">Kembali ke Beranda</a>
            </div>
        @endif

        <div class="cta-section" data-aos="flip-up">
            <h3 class="fw-bold mb-3">Mari Bergabung Menjadi Generasi Qur'ani</h3>
            <p class="text-secondary mb-4 mx-auto" style="max-width: 600px;">
                Jangan tunda niat baik Anda. Proses pendaftaran Mahasantri baru telah dibuka secara online.
            </p>
            <a href="{{ route('pendaftaran') }}" class="btn-blue-cta">
                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-back',
            once: true
        });
    });
</script>

@endsection