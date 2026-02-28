@extends('layouts.public')
@section('title', 'Kegiatan Relawan')
@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-slate-900 pt-6 pb-10 lg:pt-24 lg:pb-28 rounded-b-[1.5rem] lg:rounded-b-[4rem] mb-6 lg:mb-12 shadow-2xl">
    <!-- Decorative Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/30 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-3/4 h-3/4 bg-rose-600/20 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 pointer-events-none"></div>
    </div>

    <div class="relative z-10 max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl text-center mx-auto animate-fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-red-500/30 bg-red-500/10 text-red-100 backdrop-blur-sm mb-4 sm:mb-6">
                <i class="fas fa-hands-helping text-sm"></i>
                <span class="text-xs sm:text-sm font-semibold tracking-wide uppercase">Aksi Nyata Kita</span>
            </div>
            
            <h1 class="block font-black text-white text-3xl sm:text-5xl lg:text-7xl tracking-tight text-balance mb-3 sm:mb-6">
                Kegiatan <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-500">SerKum</span>
            </h1>
            
            <p class="text-sm sm:text-xl text-slate-300 text-balance leading-relaxed mx-auto max-w-2xl">
                Temukan dan ikuti berbagai kegiatan sosial dari SerdaduKumbang. Setiap aksi kecilmu berarti besar bagi mereka!
            </p>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-14">
    {{-- Filters (Preline Segmented Control) --}}
    <div class="flex justify-center mb-10 animate-fade-up" style="animation-delay: 200ms;">
        <nav class="flex overflow-x-auto no-scrollbar gap-1 sm:gap-2 bg-slate-100/80 hover:bg-slate-200/50 p-1.5 rounded-full smooth-transition max-w-full" aria-label="Tabs">
            @php
                $kategoris = ['Semua', 'Pendidikan', 'Sosial', 'Lingkungan', 'Kesehatan', 'Kebudayaan', 'Lainnya'];
            @endphp
            @foreach($kategoris as $kat)
                <a href="{{ route('kegiatan', ['kategori' => $kat]) }}" 
                   class="py-2 px-4 inline-flex items-center gap-x-2 bg-transparent text-xs sm:text-sm font-medium rounded-full whitespace-nowrap hover:text-gray-900 focus:outline-none focus:text-gray-900 transition-all {{ $selectedKategori == $kat ? 'bg-white text-gray-900 shadow-sm font-semibold' : 'text-gray-500 hover:bg-white/50' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Cards --}}
    @if($kegiatans->count())
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8">
            @foreach($kegiatans as $index => $k)
            <!-- Preline Card -->
            <a class="group w-full flex flex-col h-full bg-white dark:bg-slate-800 premium-shadow border border-transparent dark:border-slate-700 hover:border-red-100 smooth-transition rounded-xl sm:rounded-2xl animate-fade-up" style="animation-delay: {{ 300 + ($index * 100) }}ms;" href="{{ route('kegiatan.show', $k->id) }}">
                <div class="relative overflow-hidden pt-[65%] sm:pt-[60%] lg:pt-[50%] rounded-t-xl sm:rounded-t-2xl bg-slate-100">
                    @if($k->gambar)
                        <img class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 smooth-transition rounded-t-xl sm:rounded-t-2xl" src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}">
                    @else
                        <div class="size-full absolute top-0 start-0 flex items-center justify-center bg-slate-100">
                            <i class="fas fa-calendar-alt text-2xl sm:text-4xl text-slate-300"></i>
                        </div>
                    @endif
                    
                    @php
                        $statusClass = match($k->status) {
                            'Akan Datang' => 'bg-blue-600 text-white',
                            'Berlangsung' => 'bg-emerald-600 text-white',
                            'Selesai' => 'bg-gray-600 text-white',
                            default => 'bg-blue-600 text-white'
                        };
                    @endphp
                    <span class="absolute top-2 end-2 sm:top-3 sm:end-3 inline-flex items-center gap-x-1 sm:gap-x-1.5 py-1 px-2 sm:py-1.5 sm:px-3 rounded-md text-[9px] sm:text-xs font-semibold {{ $statusClass }}">
                        {{ $k->status }}
                    </span>
                </div>
                
                <div class="p-3 sm:p-8 flex flex-col h-full">
                    @if($k->kategori)
                        <span class="block mb-2 sm:mb-3 text-[9px] sm:text-xs font-bold text-red-600 uppercase tracking-widest">
                            {{ $k->kategori }}
                        </span>
                    @endif
                    <h3 class="text-xs sm:text-xl font-bold text-slate-900 dark:text-white group-hover:text-red-600 smooth-transition tracking-tight line-clamp-2">
                        {{ $k->judul }}
                    </h3>
                    <p class="mt-2 sm:mt-4 text-slate-500 dark:text-slate-400 line-clamp-2 sm:line-clamp-2 leading-relaxed text-[10px] sm:text-base">
                        {{ Str::limit(strip_tags($k->deskripsi), 80) }}
                    </p>
                    
                    <!-- Footer details -->
                    <div class="mt-auto pt-3 sm:pt-4 border-t border-gray-100 flex flex-col sm:flex-row sm:flex-wrap gap-x-4 gap-y-1.5 text-[9px] sm:text-xs text-gray-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-calendar text-gray-400"></i>{{ $k->tanggal->format('d M Y') }}</span>
                        <div class="flex items-center gap-x-4 gap-y-1.5">
                            <span class="flex items-center gap-1.5"><i class="fas fa-clock text-gray-400"></i>{{ $k->waktu_mulai }}</span>
                            <span class="flex items-center gap-1.5 truncate max-w-[150px]"><i class="fas fa-map-marker-alt text-gray-400"></i>{{ Str::limit($k->lokasi, 20) }}</span>
                        </div>
                    </div>
                </div>
            </a>
            <!-- End Preline Card -->
            @endforeach
        </div>
    @else
        <div class="text-center py-12 sm:py-24 bg-slate-50 dark:bg-slate-900 rounded-2xl sm:rounded-[2.5rem] border-2 border-dashed border-red-200 dark:border-slate-800 animate-fade-up">
            <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center text-red-300 text-5xl">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Belum Ada Kegiatan</h3>
            <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto text-sm">Kegiatan relawan akan ditampilkan di sini. Nantikan info terbaru!</p>
    @endif

    {{-- Pagination --}}
    @if($kegiatans->hasPages())
    <div class="mt-12 d-flex justify-content-center">
        {{ $kegiatans->links('pagination::tailwind') }}
    </div>
    @endif
</div>

@endsection
