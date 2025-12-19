<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pendaftaran PPTQ')</title>

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