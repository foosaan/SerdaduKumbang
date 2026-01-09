<footer class="footer-custom mt-5">
    <div class="container py-5 footer-container">
        <div class="row g-3 g-md-4 justify-content-between">
            <!-- Brand Section - Full width on mobile -->
            <div class="col-12 col-lg-4 footer-brand-section" data-aos="fade-up">
                <a class="navbar-brand fw-bold fs-4 text-dark mb-2 d-block" href="{{ route('home') }}">
                    <span class="text-primary">SERKUM</span> Portal
                </a>
                <p class="text-secondary small leading-relaxed mb-2">
                    Education Belongs to Every Child<br>
                    Micro Action, Huge Impact
                </p>
                <div class="social-links-footer d-flex gap-2 mt-2">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Navigasi - Half width on mobile -->
            <div class="col-6 col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <h6 class="fw-bold text-dark mb-2 mb-md-4 text-uppercase small footer-heading">Navigasi</h6>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('informasi') }}">Informasi</a></li>
                    <li><a href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>

            <!-- Akun - Half width on mobile -->
            <div class="col-6 col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <h6 class="fw-bold text-dark mb-2 mb-md-4 text-uppercase small footer-heading">Akun</h6>
                <ul class="list-unstyled footer-links mb-0">
                    @auth
                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('pendaftaran') }}">Daftar</a></li>
                    @endauth
                    <li><a href="#">Bantuan</a></li>
                </ul>
            </div>

            <!-- Kontak Kami - Hidden on mobile -->
            <div class="col-lg-3 col-md-4 d-none d-md-block" data-aos="fade-up" data-aos-delay="300">
                <h6 class="fw-bold text-dark mb-4 text-uppercase small footer-heading">Kontak Kami</h6>
                <p class="text-secondary small mb-4">
                    Punya pertanyaan atau butuh bantuan lebih lanjut? Tim kami siap melayani Anda.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary-footer">
                    Hubungi Kami <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <hr class="mt-5 mb-4 opacity-50">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <small class="text-muted">&copy; {{ date('Y') }} <strong>SerdaduKumbang</strong>. Semua Hak Dilindungi.</small>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <small class="text-muted">Developed with <i class="fas fa-heart text-danger mx-1"></i> for SerdaduKumbang</small>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer-custom {
        background-color: #ffffff;
        border-top: 1px solid #f1f5f9;
        color: #334155;
    }

    /* Styling Button Footer Baru */
    .btn-primary-footer {
        background-color: #dc2626;
        color: #ffffff;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        display: inline-block;
        text-decoration: none;
    }

    .btn-primary-footer:hover {
        background-color: #b91c1c;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
    }

    /* Styling Link Footer */
    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: #dc2626;
        padding-left: 5px;
    }

    /* Ikon Sosial Media */
    .social-links-footer a {
        width: 38px;
        height: 38px;
        background-color: #f1f5f9;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-links-footer a:hover {
        background-color: #dc2626;
        color: white;
        transform: translateY(-3px);
    }

    .leading-relaxed {
        line-height: 1.8;
    }

    @media (max-width: 767.98px) {
        .footer-custom {
            text-align: center;
        }
        .footer-custom .footer-container {
            padding-top: 1.25rem !important;
            padding-bottom: 1.25rem !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        /* Brand section stays centered */
        .footer-brand-section {
            text-align: center;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 0.5rem;
        }
        /* Link columns left aligned */
        .footer-custom .col-6 {
            text-align: left !important;
        }
        .footer-links a:hover {
            padding-left: 0;
        }
        .social-links-footer {
            justify-content: center;
            gap: 0.5rem;
        }
        .footer-links li {
            margin-bottom: 4px;
        }
        .footer-links a {
            font-size: 0.7rem;
        }
        .navbar-brand.fs-4,
        .navbar-brand.fs-4 span {
            font-size: 0.95rem !important;
        }
        .footer-heading {
            font-size: 0.65rem !important;
            letter-spacing: 0.5px;
        }
        .footer-custom p.small,
        .footer-custom p.leading-relaxed {
            font-size: 0.65rem !important;
            line-height: 1.4;
            margin-bottom: 0.5rem !important;
        }
        .social-links-footer a {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
            border-radius: 8px;
        }
        /* Bottom copyright */
        .footer-custom hr {
            margin-top: 1rem !important;
            margin-bottom: 0.75rem !important;
        }
        .footer-custom small {
            font-size: 0.55rem !important;
        }
    }

    @media (max-width: 480px) {
        .footer-custom .container {
            padding: 1.25rem 0.625rem !important;
        }
        .navbar-brand.fs-4,
        .navbar-brand.fs-4 span {
            font-size: 0.9rem !important;
        }
        .footer-links a {
            font-size: 0.7rem;
        }
        .footer-custom h6 {
            font-size: 0.65rem !important;
        }
        .footer-custom p.small,
        .footer-custom p.leading-relaxed {
            font-size: 0.65rem !important;
        }
        .btn-primary-footer {
            padding: 7px 14px;
            font-size: 0.7rem;
        }
        .social-links-footer a {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
            border-radius: 8px;
        }
        .footer-custom small {
            font-size: 0.6rem !important;
        }
    }

    @media (max-width: 375px) {
        .navbar-brand.fs-4,
        .navbar-brand.fs-4 span {
            font-size: 0.85rem !important;
        }
        .footer-links a {
            font-size: 0.65rem;
        }
        .footer-custom h6 {
            font-size: 0.6rem !important;
        }
        .footer-custom p.small,
        .footer-custom p.leading-relaxed {
            font-size: 0.6rem !important;
        }
    }
</style>