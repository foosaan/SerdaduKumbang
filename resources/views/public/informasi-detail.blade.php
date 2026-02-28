@extends('layouts.public')

@section('title', $informasi->judul)

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden pt-3 sm:pt-6 pb-3 sm:pb-6">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-slate-900 rounded-[1.5rem] lg:rounded-[3rem] px-4 sm:px-8 py-7 sm:py-10 lg:py-16 text-center overflow-hidden shadow-2xl animate-fade-up">
            <!-- Decorative Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-red-600/30 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-rose-600/20 rounded-full mix-blend-multiply blur-[80px] pointer-events-none"></div>
            </div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <span class="inline-flex items-center px-3 py-1 bg-red-500/10 backdrop-blur-md border border-red-500/30 rounded-full text-xs font-bold tracking-widest mb-3 sm:mb-6 text-red-200 uppercase">
                    {{ $informasi->kategori }}
                </span>
                <h1 class="text-xl sm:text-4xl lg:text-5xl font-black mb-3 sm:mb-6 tracking-tight text-white leading-tight">
                    {{ $informasi->judul }}
                </h1>
                <div class="flex items-center justify-center gap-4 text-slate-300 text-sm sm:text-base">
                    <span class="flex items-center gap-1.5"><i class="fas fa-calendar-alt text-red-400"></i> {{ $informasi->updated_at->format('d F Y') }}</span>
                    <span class="opacity-30">•</span>
                    <span class="flex items-center gap-1.5"><i class="fas fa-clock text-red-400"></i> {{ $informasi->updated_at->format('H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CONTENT --}}
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 lg:pb-16">
    <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-6 sm:p-8 lg:p-10">

        @if($informasi->gambar)
        <div class="text-center mb-8">
            <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="max-w-full max-h-[500px] object-contain rounded-2xl shadow-lg mx-auto">
        </div>
        @endif

        <div class="prose prose-slate max-w-3xl mx-auto text-slate-600 text-sm sm:text-base leading-relaxed sm:leading-loose">
            {!! nl2br(e($informasi->isi)) !!}
        </div>

        @if($informasi->galeri && count($informasi->galeri) > 0)
        <div class="mt-10">
            <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fas fa-images text-red-500"></i> Galeri Kegiatan
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($informasi->galeri as $foto)
                <a href="{{ asset('storage/' . $foto) }}" target="_blank" class="block overflow-hidden rounded-xl group">
                    <img src="{{ asset('storage/' . $foto) }}" alt="Gallery" class="w-full h-32 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <hr class="my-6 border-slate-100">

        <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
            <a href="{{ route('informasi') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-600/20 hover:bg-red-700 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-arrow-left"></i> Kembali ke Informasi
            </a>

            @if($informasi->kategori == 'Pendaftaran')
                <a href="{{ route('pendaftaran') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-600/20 hover:bg-red-700 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-paper-plane"></i> Daftar Sekarang
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
