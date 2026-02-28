{{-- Navigation Bar utilizing Alpine.js for robust toggling --}}
{{-- Scoped overrides: neutralize Bootstrap interference when used inside layouts.app --}}
<style>
    .navbar-tw * { box-sizing: border-box; }
    .navbar-tw a { color: inherit; text-decoration: none; }
    .navbar-tw a:hover { color: inherit; text-decoration: none; }
    .navbar-tw button { border: none; background: none; cursor: pointer; pointer-events: auto; position: relative; z-index: 10; }
    .navbar-tw img { vertical-align: middle; }
    .navbar-tw .hidden { display: none !important; }
    .navbar-tw .block { display: block !important; }
    @media (min-width: 1024px) {
        .navbar-tw .lg\:flex { display: flex !important; }
        .navbar-tw .lg\:hidden { display: none !important; }
        .navbar-tw .lg\:h-\[72px\] { height: 72px !important; }
    }
</style>
<header x-data="{ mobileMenuOpen: false }" class="navbar-tw sticky top-0 z-50 w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg border-b border-slate-100 dark:border-slate-800 transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-[72px]">

            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('assets/img/serkum logo.png') }}" alt="Logo" class="w-9 h-9 rounded-full object-cover ring-2 ring-red-100 group-hover:ring-red-300 transition">
                <span class="text-lg font-bold text-slate-800 dark:text-white tracking-tight">
                    <span class="text-red-600">Serdadu</span>Kumbang
                </span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Home
                </a>
                <a href="{{ route('informasi') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('informasi') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Informasi
                </a>
                <a href="{{ route('kegiatan') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('kegiatan*') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Kegiatan
                </a>
                <a href="{{ route('panduan') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('panduan') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Panduan
                </a>
                <a href="{{ route('pendaftaran') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('pendaftaran') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Pendaftaran
                </a>
                <a href="{{ route('contact') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('contact') ? 'text-red-600 bg-red-50' : 'text-slate-500 hover:text-red-600 hover:bg-red-50/50' }}">
                    Kontak
                </a>
            </div>

            {{-- Desktop Auth --}}
            <div class="hidden lg:flex items-center gap-3">
                <div class="w-px h-6 bg-slate-200 dark:bg-slate-700"></div>
                {{-- Theme Toggle --}}
                <button onclick="toggleDarkMode()" type="button" class="theme-toggle-btn p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition" title="Toggle tema">
                    <i class="fas fa-moon text-sm theme-icon-moon"></i>
                    <i class="fas fa-sun text-sm text-yellow-400 theme-icon-sun" style="display:none;"></i>
                </button>
                @auth
                    <div class="relative inline-flex" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" type="button" class="flex items-center gap-2 px-3 py-2 bg-slate-50 dark:bg-slate-800 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                            <i class="fas fa-user-circle text-red-500"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <svg :class="open ? 'rotate-180' : ''" class="size-4 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-full mt-2 min-w-[180px] bg-white dark:bg-slate-800 shadow-xl rounded-2xl p-2 border border-slate-100 dark:border-slate-700 z-50" 
                             style="display: none;">
                            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-slate-700 hover:text-red-600 transition">
                                <i class="fas fa-th-large w-4"></i> Dashboard
                            </a>
                            <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt w-4"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-full text-sm font-bold shadow-lg shadow-red-600/20 hover:bg-red-700 hover:shadow-red-600/30 hover:-translate-y-0.5 transition-all duration-300">
                        Login <i class="fas fa-sign-in-alt text-xs"></i>
                    </a>
                @endauth
            </div>

            {{-- Mobile Toggle --}}
            <div class="flex items-center gap-1 lg:hidden">
                {{-- Mobile Theme Toggle --}}
                <button onclick="toggleDarkMode()" type="button" class="theme-toggle-btn p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                    <i class="fas fa-moon text-sm theme-icon-moon"></i>
                    <i class="fas fa-sun text-sm text-yellow-400 theme-icon-sun" style="display:none;"></i>
                </button>
                <button type="button" class="p-2 rounded-xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition relative z-[1060] pointer-events-auto" 
                    @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenuOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" 
             x-transition
             class="overflow-hidden lg:hidden" 
             style="display: none;">
            <div class="pb-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-home w-5 mr-2"></i>Home
                </a>
                <a href="{{ route('informasi') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('informasi') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-info-circle w-5 mr-2"></i>Informasi
                </a>
                <a href="{{ route('kegiatan') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('kegiatan*') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-hand-holding-heart w-5 mr-2"></i>Kegiatan
                </a>
                <a href="{{ route('panduan') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('panduan') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-book-reader w-5 mr-2"></i>Panduan
                </a>
                <a href="{{ route('pendaftaran') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('pendaftaran') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-edit w-5 mr-2"></i>Pendaftaran
                </a>
                <a href="{{ route('contact') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'text-red-600 bg-red-50' : 'text-slate-600 hover:bg-slate-50' }}">
                    <i class="fas fa-phone-alt w-5 mr-2"></i>Kontak
                </a>

                <div class="border-t border-slate-100 dark:border-slate-800 my-2 mx-4"></div>

                @auth
                    <a href="{{ route('user.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50">
                        <i class="fas fa-th-large w-5 mr-2"></i>Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="px-4 pt-1">
                        @csrf
                        <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 transition text-left px-4">
                            <i class="fas fa-sign-out-alt w-5 mr-2"></i>Logout
                        </button>
                    </form>
                @else
                    <div class="px-4 pt-1">
                        <a href="{{ route('login') }}" class="block text-center py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-600/20 hover:bg-red-700 transition">
                            Login <i class="fas fa-sign-in-alt ml-1"></i>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
