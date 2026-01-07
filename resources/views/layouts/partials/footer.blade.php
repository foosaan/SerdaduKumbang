<footer class="footer-custom mt-5">
    <div class="container py-4 py-md-5">
        <!-- Desktop Layout -->
        <div class="row g-4 justify-content-between d-none d-md-flex">
            <div class="col-lg-4" data-aos="fade-up">
                <a class="navbar-brand fw-bold fs-4 text-dark mb-3 d-block" href="{{ route('home') }}">
                    <span class="text-primary">SERKUM</span> Portal
                </a>
                <p class="text-secondary small leading-relaxed">
                    Education Belongs to Every Child <br>
                    Micro Action, Huge Impact
                </p>
                <div class="social-links-footer d-flex gap-3 mt-4">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <h6 class="fw-bold text-dark mb-4 text-uppercase small" style="letter-spacing: 1px;">Navigasi</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('informasi') }}">Informasi</a></li>
                    <li><a href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                    <li><a href="{{ route('contact') }}">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <h6 class="fw-bold text-dark mb-4 text-uppercase small" style="letter-spacing: 1px;">Akun</h6>
                <ul class="list-unstyled footer-links">
                    @auth
                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('pendaftaran') }}">Daftar</a></li>
                    @endauth
                    <li><a href="#">Bantuan</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <h6 class="fw-bold text-dark mb-4 text-uppercase small" style="letter-spacing: 1px;">Kontak Kami</h6>
                <p class="text-secondary small mb-4">
                    Punya pertanyaan atau butuh bantuan lebih lanjut? Tim kami siap melayani Anda.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary-footer">
                    Hubungi Kami <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Mobile Layout - Compact -->
        <div class="d-md-none">
            <div class="text-center mb-3">
                <a class="navbar-brand fw-bold text-dark" href="{{ route('home') }}" style="font-size: 1rem;">
                    <span class="text-primary">SERKUM</span> Portal
                </a>
            </div>
            
            <div class="d-flex justify-content-center gap-2 mb-3 social-links-footer">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>

            <div class="row g-2 text-center mb-3">
                <div class="col-6">
                    <a href="{{ route('home') }}" class="footer-link-mobile">Home</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('informasi') }}" class="footer-link-mobile">Informasi</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('pendaftaran') }}" class="footer-link-mobile">Pendaftaran</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('contact') }}" class="footer-link-mobile">Kontak</a>
                </div>
            </div>
        </div>

        <hr class="mt-3 mt-md-5 mb-3 mb-md-4 opacity-50">

        <div class="text-center">
            <small class="text-muted" style="font-size: 0.7rem;">&copy; {{ date('Y') }} <strong>SerdaduKumbang</strong>. Semua Hak Dilindungi.</small>
        </div>
    </div>
</footer>

<style>
    .footer-custom {
        background-color: #ffffff;
        border-top: 1px solid #f1f5f9;
        color: #334155;
    }

    .footer-link-mobile {
        color: #64748b;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 500;
        display: block;
        padding: 6px 8px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .footer-link-mobile:hover {
        color: #dc2626;
        background: #fef2f2;
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
        .footer-custom .container {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
        .footer-links a:hover {
            padding-left: 0;
        }
        .social-links-footer {
            justify-content: center;
        }
        .footer-links li {
            margin-bottom: 8px;
        }
        .footer-links a {
            font-size: 0.8rem;
        }
        .navbar-brand.fs-4 {
            font-size: 1.1rem !important;
        }
        .footer-custom h6 {
            font-size: 0.75rem !important;
            margin-bottom: 0.75rem !important;
        }
        .footer-custom p.small {
            font-size: 0.75rem !important;
        }
        .btn-primary-footer {
            padding: 10px 20px;
            font-size: 0.8rem;
        }
        .social-links-footer a {
            width: 32px;
            height: 32px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .footer-custom .container {
            padding: 1.5rem 0.75rem !important;
        }
        .footer-links a {
            font-size: 0.75rem;
        }
        .footer-custom h6 {
            font-size: 0.7rem !important;
        }
        .footer-custom p.small {
            font-size: 0.7rem !important;
        }
        .btn-primary-footer {
            padding: 8px 16px;
            font-size: 0.75rem;
        }
        .social-links-footer a {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
            border-radius: 8px;
        }
        .footer-custom small {
            font-size: 0.65rem !important;
        }
    }
</style>