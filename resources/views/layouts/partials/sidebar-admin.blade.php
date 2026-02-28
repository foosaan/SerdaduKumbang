<div class="offcanvas-lg offcanvas-start sidebar-admin vh-100 d-flex flex-column transition-all" tabindex="-1" id="sidebarAdmin" aria-labelledby="sidebarAdminLabel">
    
    <!-- Mobile Offcanvas Header -->
    <div class="offcanvas-header d-lg-none border-bottom border-secondary border-opacity-25 pb-3 pt-4 px-4 bg-dark bg-opacity-10">
        <h5 class="offcanvas-title text-white fw-bold d-flex align-items-center m-0" id="sidebarAdminLabel">
            <i class="fas fa-user-shield me-2 text-danger"></i> Menu Admin
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarAdmin" aria-label="Close"></button>
    </div>

    <!-- Sidebar Body -->
    <div class="offcanvas-body d-flex flex-column h-100 p-3 p-lg-4 overflow-hidden">
        
        <!-- Desktop Brand Header -->
        <div class="sidebar-brand d-none d-lg-flex align-items-center justify-content-center gap-2 mb-4">
            <div class="brand-icon">
                <i class="fas fa-user-shield text-white fs-5"></i>
            </div>
            <h5 class="m-0 fw-bold text-white text-uppercase" style="letter-spacing: 1px;">Admin SERKUM</h5>
        </div>

        <hr class="border-secondary opacity-25 mb-4 d-none d-lg-block">

        <!-- Navigation Links -->
        <div class="d-flex flex-column flex-grow-1 overflow-y-auto w-100 sidebar-nav-scroll px-1">
            <ul class="nav flex-column gap-2 mb-4">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> <span>Dashboard Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.notifikasi') }}" class="nav-link-admin {{ request()->routeIs('admin.notifikasi') ? 'active' : '' }}">
                        <i class="fas fa-bell"></i> <span>Kirim Notifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.statusForm') }}" class="nav-link-admin {{ request()->routeIs('admin.statusForm') ? 'active' : '' }}">
                        <i class="fas fa-toggle-on"></i> <span>Status Formulir</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading mt-2 mb-3">Kegiatan Relawan</div>

            <ul class="nav flex-column gap-2 mb-4">
                <li class="nav-item">
                    <a href="{{ route('admin.kegiatan.index') }}" class="nav-link-admin {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> <span>Kelola Kegiatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.partner.index') }}" class="nav-link-admin {{ request()->routeIs('admin.partner.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i> <span>Kelola Partner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengurus.index') }}" class="nav-link-admin {{ request()->routeIs('admin.pengurus.*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap"></i> <span>Kelola Pengurus</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading mt-2 mb-3">Konten & Pengaturan</div>

            <ul class="nav flex-column gap-2 mb-2">
                <li class="nav-item">
                    <a href="{{ route('admin.informasi.index') }}" class="nav-link-admin {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i> <span>Kelola Informasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kontak') }}" class="nav-link-admin {{ request()->routeIs('admin.kontak') ? 'active' : '' }}">
                        <i class="fas fa-address-book"></i> <span>Kelola Kontak</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.akun.index') }}" class="nav-link-admin {{ request()->routeIs('admin.akun.*') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i> <span>Kelola Admin</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Footer / Logout -->
        <div class="mt-auto pt-4 border-top border-secondary border-opacity-25 w-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-logout-sidebar w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
        
    </div>
</div>

<style>
    /* Styling Mobile-First Sidebar */
    .sidebar-admin {
        width: 100%;
        max-width: 300px; /* Lebar panel di mobile */
        background: linear-gradient(180deg, #0f172a 0%, #7f1d1d 100%);
        box-shadow: 0.25rem 0 1rem rgba(0,0,0,0.1);
        z-index: 1045; /* Di bawah navbar tapi di atas konten */
    }

    /* Ketika di desktop (layar lg ke atas), jadikan sidebar statis */
    @media (min-width: 992px) {
        .sidebar-admin {
            width: clamp(260px, 20vw, 300px);
            max-width: none;
            position: sticky;
            top: 0;
            flex-shrink: 0;
        }
    }

    .brand-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-heading {
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding-left: 0.5rem;
        letter-spacing: 1.5px;
    }

    .sidebar-nav-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-nav-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(255,255,255,0.2);
        border-radius: 4px;
    }
    .sidebar-nav-scroll {
        -ms-overflow-style: none;
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,0.2) transparent;
    }

    .nav-link-admin {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        padding: clamp(0.75rem, 1.5vw, 1rem) 1.25rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        font-weight: 500;
        font-size: clamp(0.85rem, 1vw, 0.95rem);
        transition: all 0.2s ease;
    }

    .nav-link-admin i {
        font-size: 1.1rem;
        width: 2rem;
        transition: transform 0.2s ease;
    }

    .nav-link-admin:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
    }
    .nav-link-admin:hover i {
        transform: translateX(3px);
    }

    .nav-link-admin.active {
        color: #ffffff;
        background: #dc2626;
        box-shadow: 0 0.25rem 0.75rem rgba(220, 38, 38, 0.3);
    }
    .nav-link-admin.active i {
        color: #ffffff;
    }

    .btn-logout-sidebar {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        padding: clamp(0.75rem, 1.5vw, 1rem);
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn-logout-sidebar:hover {
        background: #ef4444;
        color: white;
    }
</style>