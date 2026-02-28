{{-- Preline/Tailwind Footer --}}
<footer class="bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 mt-16 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 lg:gap-12">

            {{-- Brand --}}
            <div class="col-span-2 lg:col-span-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xl font-bold text-slate-800 dark:text-white mb-3">
                    <span class="text-red-600">SERKUM</span> Portal
                </a>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-4 max-w-xs">
                    Education Belongs to Every Child<br>
                    Micro Action, Huge Impact
                </p>
                <div class="flex gap-2">
                    <a href="https://www.instagram.com/sr_serdadukumbang/" target="_blank" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 text-red-500 hover:bg-red-600 hover:text-white hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 text-red-500 hover:bg-red-600 hover:text-white hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 text-red-500 hover:bg-red-600 hover:text-white hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </a>
                    <a href="https://www.tiktok.com/@sr_serdadukumbang" target="_blank" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 text-red-500 hover:bg-red-600 hover:text-white hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fab fa-tiktok text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- Navigasi --}}
            <div>
                <h6 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-4">Navigasi</h6>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Home</a></li>
                    <li><a href="{{ route('informasi') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Informasi</a></li>
                    <li><a href="{{ route('kegiatan') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Kegiatan</a></li>
                    <li><a href="{{ route('pendaftaran') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Pendaftaran</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Kontak</a></li>
                </ul>
            </div>

            {{-- Akun --}}
            <div>
                <h6 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-4">Akun</h6>
                <ul class="space-y-3">
                    @auth
                        <li><a href="{{ route('user.dashboard') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Login</a></li>
                        <li><a href="{{ route('pendaftaran') }}" class="text-sm text-slate-500 dark:text-slate-400 hover:text-red-600 transition">Daftar</a></li>
                    @endauth

                </ul>
            </div>

            {{-- Kontak --}}
            <div class="hidden md:block">
                <h6 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-4">Kontak Kami</h6>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mb-4">
                    Punya pertanyaan? Tim kami siap melayani Anda.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-600/15 hover:bg-red-700 hover:-translate-y-0.5 transition-all duration-300">
                    Hubungi Kami <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="border-t border-slate-100 dark:border-slate-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-slate-400 dark:text-slate-500">
                &copy; {{ date('Y') }} <strong>SerdaduKumbang</strong>. Semua Hak Dilindungi.
            </p>
            <p class="text-xs text-slate-400 dark:text-slate-500">
                Developed By <a href="#" target="_blank" class="text-red-400 hover:text-red-300 font-semibold hover:underline transition-colors">Foosaan</a> for SerdaduKumbang
            </p>
        </div>
    </div>
</footer>
