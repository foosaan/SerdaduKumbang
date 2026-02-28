@extends('layouts.public')

@section('title', 'Informasi Pendaftaran')

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-slate-900 pt-6 pb-10 lg:pt-24 lg:pb-28 rounded-b-[1.5rem] lg:rounded-b-[4rem] mb-6 lg:mb-12 shadow-2xl">
    <!-- Decorative Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-red-600/30 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-3/4 h-3/4 bg-rose-600/20 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 pointer-events-none"></div>
    </div>

    <div class="relative z-10 max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl text-center mx-auto animate-fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-red-500/30 bg-red-500/10 text-red-100 backdrop-blur-sm mb-4 sm:mb-6">
                <i class="fas fa-bullhorn text-sm"></i>
                <span class="text-xs sm:text-sm font-semibold tracking-wide uppercase">Pusat Informasi</span>
            </div>
            
            <h1 class="block font-black text-white text-3xl sm:text-5xl lg:text-7xl tracking-tight text-balance mb-3 sm:mb-6">
                Update <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-500">Informasi</span>
            </h1>
            
            <p class="text-sm sm:text-xl text-slate-300 text-balance leading-relaxed mx-auto max-w-2xl">
                Simak update terbaru mengenai jadwal seleksi, persyaratan dokumen, dan pergerakan resmi SerdaduKumbang secara berkala.
            </p>
        </div>

        {{-- Preline Segmented Control Filter --}}
        <div class="mt-5 sm:mt-10 flex justify-center animate-fade-up" style="animation-delay: 200ms;">
            <nav class="flex overflow-x-auto no-scrollbar gap-x-1 bg-slate-100/80 hover:bg-slate-200/50 p-1.5 rounded-full smooth-transition max-w-full" aria-label="Tabs">
                @php
                    $categories = ['Semua', 'Pendaftaran', 'Kegiatan', 'Lainnya'];
                    $selectedCategory = $selectedKategori ?? 'Semua';
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('informasi', ['kategori' => $cat]) }}" 
                       class="py-2.5 px-6 inline-flex items-center gap-x-2 bg-transparent text-sm font-medium rounded-full whitespace-nowrap hover:text-gray-900 focus:outline-none focus:text-gray-900 transition-all {{ $selectedCategory == $cat ? 'bg-white text-gray-900 shadow-sm font-semibold' : 'text-gray-500 hover:bg-white/50' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</section>

{{-- CONTENT --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 lg:pb-16">
    @if ($informasi->count())
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8">
            @foreach ($informasi as $index => $item)
            <!-- Preline Card -->
            <div class="group flex flex-col h-full bg-white dark:bg-slate-800 premium-shadow border border-transparent dark:border-slate-700 hover:border-red-100 smooth-transition rounded-xl sm:rounded-2xl p-3 sm:p-8 animate-fade-up" style="animation-delay: {{ 300 + ($index * 100) }}ms;">
                <div class="mb-2 sm:mb-5">
                    <span class="inline-flex items-center gap-x-1 sm:gap-x-1.5 py-1 px-2 sm:py-1.5 sm:px-3 rounded-md text-[9px] sm:text-xs font-semibold bg-red-100 text-red-800">
                        {{ $item->kategori }}
                    </span>
                </div>
                <div class="my-auto">
                    <h3 class="text-xs sm:text-xl font-bold text-slate-900 dark:text-white group-hover:text-red-600 smooth-transition tracking-tight line-clamp-2 sm:line-clamp-none">
                        {{ $item->judul }}
                    </h3>
                    <p class="mt-2 sm:mt-4 text-slate-500 dark:text-slate-400 line-clamp-2 sm:line-clamp-3 leading-relaxed text-[10px] sm:text-base">
                        {{ Str::limit(strip_tags($item->isi), 80) }}
                    </p>
                </div>
                <div class="mt-auto pt-3 sm:mt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-y-2">
                    <div>
                        <p class="text-[9px] sm:text-xs text-gray-500 uppercase tracking-wider font-semibold">Rilis</p>
                        <p class="text-[10px] sm:text-sm text-gray-800">{{ $item->updated_at->format('d M y') }}</p>
                    </div>
                    <a href="{{ route('informasi.show', $item->id) }}" class="inline-flex items-center gap-x-1 sm:gap-x-2 text-[10px] sm:text-sm font-medium text-red-600 hover:text-red-800 group-hover:-translate-y-1 transition-all">
                        Detail
                        <svg class="flex-shrink-0 size-3 sm:size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
            <!-- End Preline Card -->
            @endforeach
        </div>
    @else
        <div class="text-center py-12 sm:py-24 bg-slate-50 dark:bg-slate-900 rounded-2xl sm:rounded-[2.5rem] border-2 border-dashed border-red-200 dark:border-slate-800 animate-fade-up">
            <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center text-red-300 text-5xl">
                <i class="fas fa-bullhorn"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Belum Ada Informasi</h3>
            <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-6 text-sm">
                Saat ini pengumuman pendaftaran belum tersedia. Tim admin kami sedang mempersiapkan update terbaru untuk Anda.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-red-200 text-red-600 rounded-full font-bold text-sm hover:bg-red-50 transition">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    @endif

    {{-- Pagination --}}
    @if($informasi->hasPages())
    <div class="mt-12 d-flex justify-content-center">
        {{ $informasi->links('pagination::tailwind') }}
    </div>
    @endif
</section>

@endsection