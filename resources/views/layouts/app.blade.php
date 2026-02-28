<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <meta name="turbo-visit-control" content="reload">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pendaftaran Serdadu Kumbang')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Perbaikan Global agar tidak ada scroll horizontal akibat animasi */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body, #f1f5f9);
            color: var(--text-body, #334155);
            overflow-x: hidden; 
            width: 100%;
        }

        /* Styling Alert Global agar tidak menempel ke navbar */
        .global-alert {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
        }

        /* Menyesuaikan jarak konten jika ada sidebar admin */
        .main-content {
            min-height: 80vh;
        }

        /* Global Admin Topbar */
        .admin-topbar-global {
            background: var(--bg-card, white);
            border-bottom: 1px solid var(--border-color, #e2e8f0);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .admin-topbar-global .topbar-title { font-size: 1rem; font-weight: 800; color: var(--text-heading, #0f172a); margin: 0; }
        .admin-topbar-global .topbar-sub { font-size: 0.72rem; color: var(--text-muted, #94a3b8); font-weight: 500; margin-top: 1px; }
        .admin-topbar-global .user-chip {
            display: flex; align-items: center; gap: 0.5rem;
            background: var(--bg-muted, #f8fafc); border: 1px solid var(--border-color, #e2e8f0);
            border-radius: 100px; padding: 0.3rem 0.75rem 0.3rem 0.3rem;
        }
        .admin-topbar-global .user-avatar {
            width: 26px; height: 26px; border-radius: 50%;
            background: linear-gradient(135deg, #dc2626, #9f1239);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.65rem; font-weight: 800;
        }
        .admin-topbar-global .user-name { font-size: 0.78rem; font-weight: 700; color: var(--text-body, #334155); }

        /* Efek transisi antar halaman */
        .page-transition {
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* ========== MOBILE RESPONSIVE STYLES ========== */
        @media (max-width: 768px) {
            /* Typography scaling */
            h1 { font-size: 1.5rem !important; }
            h2 { font-size: 1.3rem !important; }
            h3 { font-size: 1.1rem !important; }
            h4 { font-size: 1rem !important; }
            p, span, label { font-size: 0.875rem !important; }
            
            /* Container padding */
            .container { padding-left: 12px !important; padding-right: 12px !important; }
            
            /* Cards mobile */
            .card { margin-bottom: 0.75rem !important; }
            .card-body { padding: 0.875rem !important; }
            
            /* Buttons mobile */
            .btn { padding: 0.5rem 0.875rem !important; font-size: 0.8rem !important; }
            .btn-lg { padding: 0.6rem 1rem !important; font-size: 0.85rem !important; }
            
            /* Forms mobile */
            .form-control, .form-select { font-size: 14px !important; padding: 0.6rem !important; }
            
            /* Tables mobile */
            .table-responsive { font-size: 0.75rem; }
            .table th, .table td { padding: 0.4rem !important; white-space: nowrap; }
            
            /* Stat cards */
            .stat-card-admin { padding: 12px !important; gap: 8px !important; }
            .stat-icon { width: 40px !important; height: 40px !important; font-size: 1rem !important; }
            
            /* Filter cards */
            .filter-card { padding: 12px !important; }
            
            /* Global alert mobile */
            .global-alert { 
                min-width: auto !important; 
                left: 10px; 
                right: 10px; 
                font-size: 0.8rem;
                padding: 0.75rem !important;
            }
            
            /* Navbar mobile */
            .navbar-brand img { height: 30px !important; }
            .navbar { padding: 0.4rem 0.75rem !important; }
            
            /* Section spacing */
            section { padding: 1.5rem 0 !important; }
            .py-5 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
            .mb-5 { margin-bottom: 1.5rem !important; }
        }

        @media (max-width: 576px) {
            /* Small phones */
            h1 { font-size: 1.3rem !important; }
            h2 { font-size: 1.15rem !important; }
            h3 { font-size: 1rem !important; }
            p, span, label { font-size: 0.8rem !important; }
            
            /* Full width buttons */
            .btn-action { width: 100% !important; margin-bottom: 0.5rem; }
            
            /* Stack columns */
            .d-flex.gap-2 { flex-wrap: wrap; }
            
            /* Reduce padding */
            .p-4 { padding: 0.875rem !important; }
            .p-5 { padding: 1rem !important; }
            
            .card-body { padding: 0.75rem !important; }
        }

        @media (max-width: 400px) {
            /* Very small phones (iPhone SE, older phones) */
            h1 { font-size: 1.15rem !important; }
            h2 { font-size: 1rem !important; }
            h3 { font-size: 0.9rem !important; }
            p, span, label { font-size: 0.75rem !important; }
            
            .btn { padding: 0.4rem 0.6rem !important; font-size: 0.75rem !important; }
            .form-control, .form-select { font-size: 13px !important; padding: 0.5rem !important; }
            
            .container { padding-left: 8px !important; padding-right: 8px !important; }
            .card-body { padding: 0.6rem !important; }
            
            .table th, .table td { padding: 0.3rem !important; font-size: 0.7rem !important; }
        }
    </style>
</head>
<body>
    {{-- ALERT GLOBAL --}}
    @if(session('error') || session('success'))
    <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show global-alert" role="alert">
        <i class="fas {{ session('error') ? 'fa-exclamation-circle' : 'fa-check-circle' }} me-2"></i>
        {{ session('error') ?? session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- NAVBAR PUBLIC (Tailwind - Unified) --}}
    @auth
        @if (auth()->user()->role !== 'admin')
            @include('layouts.partials.navbar-public')
        @endif
    @else
        @include('layouts.partials.navbar-public')
    @endauth

    <div class="d-flex flex-column flex-lg-row main-content">
        {{-- SIDEBAR ADMIN / MOBILE HEADER --}}
        @auth
            @if (auth()->user()->role === 'admin')
                <!-- Header khusus mobile untuk trigger Offcanvas -->
                <div class="d-lg-none d-flex justify-content-between align-items-center text-white px-3 py-3 w-100 shadow-sm" style="background: linear-gradient(90deg, #0f172a 0%, #7f1d1d 100%);">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-white bg-opacity-10 p-2 rounded-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-shield text-white fs-6"></i>
                        </div>
                        <h6 class="m-0 pe-2 fw-bold text-white letter-spacing-1">Admin SERKUM</h6>
                    </div>
                    <button class="btn btn-sm btn-outline-light border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAdmin" aria-controls="sidebarAdmin">
                        <i class="fas fa-bars fs-5"></i>
                    </button>
                </div>
                
                @include('layouts.partials.sidebar-admin')
            @endif
        @endauth

        {{-- CONTENT --}}
        <div class="flex-grow-1 page-transition w-100" style="background: var(--bg-body, #f1f5f9); min-height: 100vh;">
            @auth
                @if(auth()->user()->role === 'admin')
                    {{-- Sticky Admin Topbar --}}
                    <div class="admin-topbar-global d-none d-lg-flex">
                        <div>
                            <p class="topbar-title">@yield('page-title', 'Admin Panel')</p>
                            <p class="topbar-sub">@yield('breadcrumb-sub', 'SerdaduKumbang Admin')</p>
                        </div>
                        <div class="user-chip">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                @endif
            @endauth
            @yield('content')
        </div>
    </div>

    {{-- FOOTER (Unified Tailwind) --}}
    @if (!str_starts_with(Route::currentRouteName(), 'admin.'))
        @include('layouts.partials.footer-public')
    @endif
    
    {{-- PERBAIKAN: Cukup panggil Bootstrap Bundle satu kali di akhir body --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi AOS Global
            AOS.init({
                duration: 400,
                easing: 'ease-out',
                once: true,
                mirror: false
            });

            // Auto close alert setelah 5 detik
            window.setTimeout(function() {
                var alert = document.querySelector(".global-alert");
                if (alert && typeof bootstrap !== 'undefined') {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
    </script>
</body>
</html>