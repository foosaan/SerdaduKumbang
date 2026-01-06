<nav class="navbar navbar-expand-lg sticky-top navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/serkum logo.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle object-fit-cover">
            <span class="brand-accent">SerdaduKumbang</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fas fa-bars text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('informasi') ? 'active' : '' }}" href="{{ route('informasi') }}">Informasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}">Pendaftaran</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                </li>

                <div class="nav-divider d-none d-lg-block mx-3"></div>

                @auth
                    <li class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle user-profile-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fs-5 me-2 text-primary"></i> 
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 py-2 px-2" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item rounded-3" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-th-large me-2"></i> Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger rounded-3 d-flex align-items-center">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-login-nav px-4" href="{{ route('login') }}">
                            Login <i class="fas fa-sign-in-alt ms-1 small"></i>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Styling Dasar Navbar */
    .navbar-custom {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 12px 0;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        z-index: 1050; /* Pastikan di atas konten lain */
    }

    .navbar-brand { font-size: 1.5rem; color: #0f172a !important; letter-spacing: -1px; }
    .brand-accent { color: #dc2626; }

    .nav-link {
        color: #64748b !important;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .nav-link:hover, .nav-link.active { color: #dc2626 !important; }
    
    /* Underline animation */
    .nav-link::after {
        content: ''; position: absolute; width: 0; height: 2px;
        bottom: -2px; left: 8px; background: #dc2626; transition: width 0.3s;
    }
    .nav-link:hover::after, .nav-link.active::after { width: calc(100% - 16px); }

    .nav-divider { width: 1px; height: 24px; background: #e2e8f0; }

    .btn-login-nav {
        background: #dc2626;
        color: white !important;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);
        transition: all 0.3s ease;
        border: none;
    }
    .btn-login-nav:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 38, 38, 0.3);
    }

    /* Perbaikan User Profile Dropdown */
    .user-profile-link {
        color: #1e293b !important;
        background: #f1f5f9;
        padding: 6px 16px !important;
        border-radius: 50px;
    }
    .user-profile-link::after { display: none; } /* Hilangkan panah default bootstrap jika diinginkan */

    .dropdown-menu {
        border-radius: 16px;
        min-width: 180px;
        z-index: 1100;
    }
    .dropdown-item {
        font-weight: 600;
        padding: 10px 15px;
        color: #64748b;
        transition: 0.2s;
    }
    .dropdown-item:hover {
        background-color: #f1f7ff;
        color: #dc2626;
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white; margin-top: 15px; padding: 20px;
            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .nav-link::after { display: none; }
        .navbar-nav .nav-item { margin-bottom: 10px; width: 100%; }
        .user-profile-link { background: transparent; padding: 10px 0 !important; }
        .btn-login-nav { width: 100%; margin-top: 10px; }
    }
</style>
