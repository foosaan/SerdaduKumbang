<!DOCTYPE html>
<html lang="id">
<head>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Perbaikan Global agar tidak ada scroll horizontal akibat animasi */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
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

        /* Efek transisi antar halaman */
        .page-transition {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* ========== MOBILE RESPONSIVE STYLES ========== */
        @media (max-width: 768px) {
            /* Typography scaling */
            h1 { font-size: 1.75rem !important; }
            h2 { font-size: 1.5rem !important; }
            h3 { font-size: 1.25rem !important; }
            h4 { font-size: 1.1rem !important; }
            p, span, label { font-size: 0.95rem !important; }
            
            /* Container padding */
            .container { padding-left: 15px !important; padding-right: 15px !important; }
            
            /* Cards mobile */
            .card { margin-bottom: 1rem !important; }
            .card-body { padding: 1rem !important; }
            
            /* Buttons mobile */
            .btn { padding: 0.6rem 1rem !important; font-size: 0.9rem !important; }
            .btn-lg { padding: 0.75rem 1.25rem !important; }
            
            /* Forms mobile */
            .form-control, .form-select { font-size: 16px !important; padding: 0.75rem !important; }
            
            /* Tables mobile */
            .table-responsive { font-size: 0.85rem; }
            .table th, .table td { padding: 0.5rem !important; white-space: nowrap; }
            
            /* Hero sections */
            .hero-section h1 { font-size: 1.75rem !important; }
            .hero-section p { font-size: 1rem !important; }
            
            /* Stat cards */
            .stat-card-admin { padding: 15px !important; gap: 10px !important; }
            .stat-icon { width: 45px !important; height: 45px !important; font-size: 1.1rem !important; }
            
            /* Filter cards */
            .filter-card { padding: 15px !important; }
            .filter-card .row { gap: 10px; }
            
            /* Global alert mobile */
            .global-alert { 
                min-width: auto !important; 
                left: 15px; 
                right: 15px; 
                font-size: 0.9rem;
            }
            
            /* Navbar mobile */
            .navbar-brand img { height: 35px !important; }
            .navbar { padding: 0.5rem 1rem !important; }
            
            /* Section spacing */
            section { padding: 2rem 0 !important; }
            .py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
            .mb-5 { margin-bottom: 2rem !important; }
        }

        @media (max-width: 576px) {
            /* Extra small devices */
            h1 { font-size: 1.5rem !important; }
            h2 { font-size: 1.3rem !important; }
            
            /* Full width buttons on small */
            .btn-action { width: 100% !important; margin-bottom: 0.5rem; }
            
            /* Stack columns */
            .d-flex.gap-2 { flex-wrap: wrap; }
            
            /* Reduce padding */
            .p-4 { padding: 1rem !important; }
            .p-5 { padding: 1.5rem !important; }
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

    {{-- NAVBAR USER --}}
    @auth
        @if (auth()->user()->role !== 'admin')
            @include('layouts.partials.navbar-user')
        @endif
    @else
        @include('layouts.partials.navbar-user')
    @endauth

    <div class="d-flex main-content">
        {{-- SIDEBAR ADMIN --}}
        @auth
            @if (auth()->user()->role === 'admin')
                @include('layouts.partials.sidebar-admin')
            @endif
        @endauth

        {{-- CONTENT --}}
        <div class="flex-grow-1 p-0 p-md-0 page-transition"> {{-- Ubah p-4 menjadi 0 agar hero/carousel bisa full width --}}
            @yield('content')
        </div>
    </div>

    <!-- {{-- FOOTER --}}
    @if (!Request::is('admin*') && !Request::is('*/admin/*'))
        @include('layouts.partials.footer')
    @endif -->

    {{-- FOOTER --}}
    @if (!str_starts_with(Route::currentRouteName(), 'admin.'))
        @include('layouts.partials.footer')
    @endif
    
    {{-- PERBAIKAN: Cukup panggil Bootstrap Bundle satu kali di akhir body --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS Global
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Auto close alert setelah 5 detik
        window.setTimeout(function() {
            var alert = document.querySelector(".global-alert");
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
</body>
</html>