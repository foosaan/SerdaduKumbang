<div class="sidebar-admin vh-100 d-flex flex-column p-3">
    <div class="sidebar-brand d-flex align-items-center justify-content-center gap-2 mb-4">
        <div class="brand-icon">
            <i class="fas fa-user-shield text-white"></i>
        </div>
        <h5 class="m-0 fw-bold text-white letter-spacing-1">Admin PPTQ</h5>
    </div>

    <hr class="border-secondary opacity-25 mb-4">

    <ul class="nav flex-column gap-2 flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large me-2"></i> <span>Dashboard Admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.notifikasi') }}" class="nav-link-admin {{ request()->routeIs('admin.notifikasi') ? 'active' : '' }}">
                <i class="fas fa-bell me-2"></i> <span>Kirim Notifikasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.statusForm') }}" class="nav-link-admin {{ request()->routeIs('admin.statusForm') ? 'active' : '' }}">
                <i class="fas fa-toggle-on me-2"></i> <span>Status Formulir</span>
            </a>
        </li>
        
        <div class="sidebar-heading mt-3 mb-2">Konten & Pengaturan</div>

        <li class="nav-item">
            <a href="{{ route('admin.informasi.index') }}" class="nav-link-admin {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-2"></i> <span>Kelola Informasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.kontak') }}" class="nav-link-admin {{ request()->routeIs('admin.kontak') ? 'active' : '' }}">
                <i class="fas fa-address-book me-2"></i> <span>Kelola Kontak</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.akun.index') }}" class="nav-link-admin {{ request()->routeIs('admin.akun.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog me-2"></i> <span>Kelola Admin</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-logout-sidebar w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-out-alt"></i> <span>Keluar Sistem</span>
            </button>
        </form>
    </div>
</div>

<style>
    /* Dasar Sidebar */
    .sidebar-admin {
        width: 270px;
        background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%); /* Navy to Dark Blue */
        box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: sticky;
        top: 0;
    }

    /* Branding */
    .brand-icon {
        width: 35px;
        height: 35px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .letter-spacing-1 { letter-spacing: 1px; }

    /* Heading Section */
    .sidebar-heading {
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding-left: 15px;
        letter-spacing: 1.5px;
    }

    /* Navigation Link */
    .nav-link-admin {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .nav-link-admin i {
        font-size: 1.1rem;
        width: 25px;
        transition: transform 0.2s ease;
    }

    .nav-link-admin:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
    }

    .nav-link-admin:hover i {
        transform: translateX(3px);
    }

    /* Active State */
    .nav-link-admin.active {
        color: #ffffff;
        background: #2563eb; /* Biru cerah sesuai tema */
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .nav-link-admin.active i {
        color: #ffffff;
    }

    /* Logout Button */
    .btn-logout-sidebar {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn-logout-sidebar:hover {
        background: #ef4444;
        color: white;
    }

    /* Sembunyikan teks di layar kecil jika perlu (opsional) */
    @media (max-width: 991.98px) {
        /* Tambahkan logika collapse sidebar jika dibutuhkan */
    }
</style>