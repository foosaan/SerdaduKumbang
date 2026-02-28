@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden pt-4 pb-4 sm:pt-6 sm:pb-6">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-slate-900 rounded-[1.5rem] lg:rounded-[3rem] px-5 sm:px-8 py-8 sm:py-12 lg:py-16 text-center overflow-hidden shadow-2xl animate-fade-up">
            <!-- Decorative Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-red-600/30 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-rose-600/20 rounded-full mix-blend-multiply blur-[80px] pointer-events-none"></div>
            </div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-500/10 backdrop-blur-md border border-red-500/30 rounded-full text-xs font-bold tracking-widest mb-4 sm:mb-6 text-red-200 uppercase">
                    <i class="fas fa-headset text-sm"></i> Layanan Informasi
                </span>
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black mb-3 sm:mb-6 tracking-tight text-white leading-tight text-balance">
                    Hubungi <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-500">Kami</span>
                </h1>
                <p class="text-slate-300 text-sm leading-relaxed max-w-2xl mx-auto text-balance">
                    Punya pertanyaan mengenai pendaftaran atau program SerdaduKumbang? Tim kami siap membantu Anda dengan ramah dan cepat.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CONTENT --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 lg:pb-16">
    @if($kontak)
        {{-- Contact Cards --}}
        <div class="grid md:grid-cols-3 gap-3 sm:gap-5 mb-12">
            {{-- Lokasi --}}
            <div class="group bg-white dark:bg-slate-800 rounded-2xl md:rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:-translate-y-1 md:hover:-translate-y-2 hover:border-red-200 transition-all duration-300 p-4 sm:p-5 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 md:h-1.5 bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-center gap-4 md:flex-col md:text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 md:mx-auto shrink-0 rounded-xl md:rounded-2xl bg-red-50 text-red-600 flex items-center justify-center text-xl md:text-2xl md:mb-5 group-hover:bg-red-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-0.5 md:mb-3 text-sm md:text-base">Lokasi</h4>
                        <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm leading-relaxed">{{ $kontak->alamat }}</p>
                    </div>
                </div>
            </div>

            {{-- WhatsApp --}}
            <div class="group bg-white dark:bg-slate-800 rounded-2xl md:rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:-translate-y-1 md:hover:-translate-y-2 hover:border-red-200 transition-all duration-300 p-4 sm:p-5 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 md:h-1.5 bg-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-center gap-4 md:flex-col md:text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 md:mx-auto shrink-0 rounded-xl md:rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl md:text-2xl md:mb-5 group-hover:bg-red-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-0.5 md:mb-3 text-sm md:text-base">WhatsApp</h4>
                        <a href="tel:{{ $kontak->telepon }}" class="block text-sm md:text-lg font-bold text-slate-900 dark:text-white hover:text-red-600 transition">{{ $kontak->telepon }}</a>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Aktif: 08:00 - 16:00 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="group bg-white dark:bg-slate-800 rounded-2xl md:rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:-translate-y-1 md:hover:-translate-y-2 hover:border-red-200 transition-all duration-300 p-4 sm:p-5 md:p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 md:h-1.5 bg-amber-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-center gap-4 md:flex-col md:text-center">
                    <div class="w-12 h-12 md:w-16 md:h-16 md:mx-auto shrink-0 rounded-xl md:rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl md:text-2xl md:mb-5 group-hover:bg-red-600 group-hover:text-white group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <div class="min-w-0 w-full">
                        <h4 class="font-bold text-slate-900 dark:text-white mb-0.5 md:mb-3 text-sm md:text-base">Email</h4>
                        <a href="mailto:{{ $kontak->email }}" class="block text-xs md:text-sm font-bold text-slate-900 dark:text-white hover:text-red-600 transition">{{ $kontak->email }}</a>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Balasan dalam 24 jam</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="text-center py-8 mb-8">
            <h4 class="font-bold text-slate-900 dark:text-white mb-5">Temukan Kami di Media Sosial</h4>
            <div class="flex justify-center gap-3">
                <a href="https://www.instagram.com/sr_serdadukumbang/" target="_blank" class="w-12 h-12 inline-flex items-center justify-center rounded-2xl bg-gradient-to-br from-[#f09433] via-[#dc2743] to-[#bc1888] text-white text-lg hover:-translate-y-1 hover:rotate-6 transition-all duration-300 shadow-lg shadow-pink-500/20">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.tiktok.com/@sr_serdadukumbang" target="_blank" class="w-12 h-12 inline-flex items-center justify-center rounded-2xl bg-[#010101] text-white text-lg hover:-translate-y-1 hover:rotate-6 transition-all duration-300 shadow-lg shadow-slate-500/20">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>

        {{-- Map --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-lg p-6 sm:p-8 mb-12">
            <div class="text-center mb-5">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center justify-center gap-2">
                    <i class="fas fa-directions text-red-500"></i> Panduan Lokasi
                </h3>
                <p class="text-slate-400 text-sm mt-1">Navigasi langsung menggunakan Google Maps</p>
            </div>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7436.156942153772!2d110.3545138285384!3d-7.793163600437046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58216dce1ec3%3A0x1779013e69ec67fe!2sPringgokusuman%2C%20Gedong%20Tengen%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta!5e1!3m2!1sid!2sid!4v1767717126182!5m2!1sid!2sid" 
                class="w-full h-64 sm:h-96 rounded-2xl border-0 grayscale-[10%]"
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

    @else
        <div class="text-center py-20">
            <i class="fas fa-comment-slash text-5xl text-slate-200 mb-5 block"></i>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Informasi Kontak Belum Tersedia</h3>
            <p class="text-slate-500 dark:text-slate-400 mb-6 text-sm">Data kontak sedang dalam pemeliharaan. Silakan kembali lagi nanti.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-2xl font-bold text-sm shadow-xl hover:bg-red-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    @endif

    {{-- CTA --}}
    <div class="bg-slate-50 rounded-3xl border border-slate-100 p-10 sm:p-14 text-center">
        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white mb-4">Mari Bergabung Menjadi SerdaduKumbang</h3>
        <a href="{{ route('pendaftaran') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-red-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-red-600/25 hover:bg-red-700 hover:-translate-y-1 transition-all duration-300">
            <i class="fas fa-user-plus"></i> Daftar Sekarang
        </a>
    </div>
</section>

@endsection