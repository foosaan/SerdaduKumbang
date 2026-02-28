<nav class="navbar navbar-expand-lg sticky-top navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}" data-turbo="false">
            <img src="{{ asset('assets/img/serkum logo.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle object-fit-cover">
            <span class="brand-accent">SerdaduKumbang</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none position-relative" style="z-index: 1060; pointer-events: auto;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fas fa-bars text-primary"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" data-turbo="false">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('informasi') ? 'active' : '' }}" href="{{ route('informasi') }}" data-turbo="false">Informasi</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('kegiatan*') ? 'active' : '' }}" href="{{ route('kegiatan') }}" data-turbo="false">Kegiatan</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}" data-turbo="false">Pendaftaran</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}" data-turbo="false">Kontak</a>
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
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0" data-turbo="false">
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
    /* Mobile-First Navbar Styling */
    .navbar-custom {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: clamp(0.5rem, 1.5vw, 1rem) 0;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        z-index: 1050;
    }

    .navbar-brand { 
        font-size: clamp(1.1rem, 2.5vw, 1.5rem); 
        color: #0f172a !important; 
        letter-spacing: -0.5px; 
    }
    
    .navbar-brand img {
        width: clamp(32px, 5vw, 40px);
        height: clamp(32px, 5vw, 40px);
        object-fit: contain;
    }
    
    .brand-accent { color: #dc2626; }

    .nav-link {
        color: #64748b !important;
        font-weight: 600;
        font-size: clamp(0.9rem, 1.5vw, 1rem);
        transition: all 0.2s ease;
        position: relative;
        padding: 0.5rem 1rem !important;
    }
    
    .nav-link:hover, .nav-link.active { color: #dc2626 !important; }
    
    @media (min-width: 992px) {
        .nav-link::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: 0; left: 1rem; background: #dc2626; transition: width 0.3s;
        }
        .nav-link:hover::after, .nav-link.active::after { width: calc(100% - 2rem); }
        .nav-divider { width: 1px; height: 1.5rem; background: #e2e8f0; }
    }

    .btn-login-nav {
        background: #dc2626;
        color: white !important;
        border-radius: 50px;
        font-weight: 700;
        font-size: clamp(0.85rem, 1.5vw, 0.95rem);
        padding: 0.5rem 1.5rem;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);
        transition: all 0.3s ease;
        border: none;
        width: 100%;
        text-align: center;
        margin-top: 0.5rem;
    }
    @media (min-width: 992px) {
        .btn-login-nav {
            width: auto;
            margin-top: 0;
        }
    }
    
    .btn-login-nav:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 38, 38, 0.3);
    }

    .user-profile-link {
        color: #1e293b !important;
        background: transparent;
        padding: 0.5rem 0 !important;
        border-radius: 50px;
    }
    @media (min-width: 992px) {
        .user-profile-link {
            background: #f1f5f9;
            padding: 0.375rem 1rem !important;
        }
    }
    .user-profile-link::after { display: none; }

    .dropdown-menu {
        border-radius: 1rem;
        min-width: 180px;
        z-index: 1100;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .dropdown-item {
        font-weight: 600;
        padding: 0.6rem 1rem;
        color: #64748b;
        transition: 0.2s;
    }
    .dropdown-item:hover {
        background-color: #fef2f2;
        color: #dc2626;
        border-radius: 0.5rem;
    }

    /* Mobile Navbar Collapse Container */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white; 
            margin-top: 0.75rem; 
            padding: 1rem;
            border-radius: 1rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .navbar-nav .nav-item { margin-bottom: 0.25rem; }
    }

    /* ===== DARK MODE ===== */
    html.dark .navbar-custom {
        background: rgba(15, 23, 42, 0.95);
        border-bottom-color: rgba(51, 65, 85, 0.8);
    }
    html.dark .navbar-brand {
        color: #f1f5f9 !important;
    }
    html.dark .nav-link {
        color: #94a3b8 !important;
    }
    html.dark .nav-link:hover,
    html.dark .nav-link.active {
        color: #ef4444 !important;
    }
    html.dark .nav-divider {
        background: #334155;
    }
    html.dark .user-profile-link {
        color: #e2e8f0 !important;
    }
    @media (min-width: 992px) {
        html.dark .user-profile-link {
            background: #1e293b;
        }
    }
    html.dark .dropdown-menu {
        background: #1e293b;
        border-color: #334155;
    }
    html.dark .dropdown-item {
        color: #94a3b8;
    }
    html.dark .dropdown-item:hover {
        background-color: #334155;
        color: #ef4444;
    }
    html.dark .dropdown-divider {
        border-color: #334155;
    }
    @media (max-width: 991.98px) {
        html.dark .navbar-collapse {
            background: #1e293b;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    }
    html.dark .navbar-toggler {
        border-color: #334155;
    }
    html.dark .navbar-toggler .fa-bars {
        color: #94a3b8 !important;
    }
</style>
