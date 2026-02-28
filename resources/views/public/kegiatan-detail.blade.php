@extends('layouts.public')
@section('title', $kegiatan->judul)
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
                @if($kegiatan->gambar)
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-luminosity" alt="">
                @endif
            </div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <div class="mb-3 sm:mb-6">
                    <a href="{{ route('kegiatan') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-sm transition font-medium">
                        <i class="fas fa-arrow-left"></i> Kembali ke Kegiatan
                    </a>
                </div>

                <div class="flex flex-wrap justify-center gap-2 mb-3 sm:mb-6">
                    @if($kegiatan->kategori)
                        <span class="inline-flex items-center px-4 py-1.5 bg-red-500/10 backdrop-blur-md border border-red-500/30 rounded-full text-xs font-bold tracking-widest text-red-200 uppercase">
                            {{ $kegiatan->kategori }}
                        </span>
                    @endif
                    @php
                        $statusClass = match($kegiatan->status) {
                            'Akan Datang' => 'bg-blue-500/20 text-blue-200 border-blue-500/30',
                            'Berlangsung' => 'bg-emerald-500/20 text-emerald-200 border-emerald-500/30',
                            'Selesai' => 'bg-slate-500/20 text-slate-300 border-slate-500/30',
                            default => 'bg-blue-500/20 text-blue-200 border-blue-500/30'
                        };
                    @endphp
                    <span class="inline-flex items-center px-4 py-1.5 backdrop-blur-md border rounded-full text-xs font-bold tracking-widest uppercase {{ $statusClass }}">
                        {{ $kegiatan->status }}
                    </span>
                </div>
                
                <h1 class="text-xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    {{ $kegiatan->judul }}
                </h1>
            </div>
        </div>
    </div>
</section>

{{-- CONTENT --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-14">
    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Main --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8">
                <h5 class="font-bold text-slate-900 mb-4">Tentang Kegiatan</h5>
                <div class="text-slate-600 text-sm sm:text-base leading-relaxed whitespace-pre-line">{{ $kegiatan->deskripsi }}</div>
            </div>

            @if($kegiatan->gambar)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8">
                <h5 class="font-bold text-slate-900 mb-4">Dokumentasi</h5>
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="w-full rounded-2xl" alt="{{ $kegiatan->judul }}">
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h6 class="font-bold text-slate-900 mb-5">Detail Kegiatan</h6>

                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-4 border-b border-slate-50">
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Tanggal</p>
                            <p class="font-semibold text-slate-900 text-sm">{{ $kegiatan->tanggal->format('l, d F Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pb-4 border-b border-slate-50">
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Waktu</p>
                            <p class="font-semibold text-slate-900 text-sm">{{ $kegiatan->waktu_mulai }}{{ $kegiatan->waktu_selesai ? ' - '.$kegiatan->waktu_selesai : '' }} WIB</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pb-4 border-b border-slate-50">
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Lokasi</p>
                            <p class="font-semibold text-slate-900 text-sm">{{ $kegiatan->lokasi }}</p>
                        </div>
                    </div>

                    @if($kegiatan->jumlah_partisipan)
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Partisipan</p>
                            <p class="font-semibold text-slate-900 text-sm">{{ $kegiatan->jumlah_partisipan }} orang</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
