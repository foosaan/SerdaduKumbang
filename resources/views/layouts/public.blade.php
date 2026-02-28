<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <script>
        (function() {
            var t = localStorage.getItem('theme');
            if (t === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pendaftaran Serdadu Kumbang')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased transition-colors duration-300">

    {{-- ALERT GLOBAL --}}
    @if(session('error') || session('success'))
    <div id="global-alert" class="fixed top-20 right-4 z-[9999] min-w-[300px] max-w-md animate-fade-in">
        <div class="p-4 rounded-2xl shadow-xl border {{ session('error') ? 'bg-red-50 border-red-200 text-red-700' : 'bg-emerald-50 border-emerald-200 text-emerald-700' }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas {{ session('error') ? 'fa-exclamation-circle' : 'fa-check-circle' }}"></i>
                    <span class="text-sm font-semibold">{{ session('error') ?? session('success') }}</span>
                </div>
                <button onclick="document.getElementById('global-alert').remove()" class="text-current opacity-60 hover:opacity-100 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alert = document.getElementById('global-alert');
                if (alert) alert.style.transition = 'opacity 0.5s', alert.style.opacity = '0', setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    </script>
    @endif

    {{-- NAVBAR --}}
    @include('layouts.partials.navbar-public')

    {{-- CONTENT --}}
    <main class="min-h-[80vh]">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.partials.footer-public')

    @stack('scripts')
</body>
</html>
