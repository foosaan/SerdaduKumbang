@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- HERO SECTION --}}
<div class="relative overflow-hidden bg-slate-900 pt-6 pb-14 lg:pt-16 lg:pb-32 space-y-6 lg:space-y-24 rounded-b-[1.5rem] lg:rounded-b-[4rem] mb-6 lg:mb-12 shadow-2xl">
    <!-- Background Image & Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="/assets/img/serkum.jpg" alt="Hero Background" class="w-full h-full object-cover">
        <!-- Complex Gradient Overlay for depth -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-slate-900/80 to-red-900/40 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
    </div>

    <!-- Decorative particles/shapes -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-4 sm:pt-16">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-red-500/30 bg-red-500/10 text-red-100 backdrop-blur-sm mb-4 sm:mb-8 animate-fade-up">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            <span class="text-xs sm:text-sm font-semibold tracking-wide uppercase">Education Belongs to Every Child</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-7xl font-extrabold text-white tracking-tight mb-3 sm:mb-6 animate-fade-up" style="animation-delay: 100ms;">
            Sekolah Rakyat<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-500">Serdadu Kumbang</span>
        </h1>

        <!-- Description -->
        <p class="mt-2 sm:mt-4 text-sm sm:text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed text-balance animate-fade-up" style="animation-delay: 200ms;">
            Sebuah NGO di bidang pendidikan yang berfokus pada pengembangan karakter serta pemenuhan hak-hak anak Indonesia.
        </p>

        <!-- CTA Buttons -->
        <div class="mt-5 sm:mt-12 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center animate-fade-up" style="animation-delay: 300ms;">
            <a href="{{ route('pendaftaran') }}" class="group relative inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 font-bold text-white bg-red-600 rounded-full overflow-hidden transition-all hover:scale-105 hover:shadow-[0_0_40px_-10px_rgba(220,38,38,0.5)] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-900 w-full sm:w-auto">
                <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                <span class="relative flex items-center gap-2">
                    Mulai Pendaftaran
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </span>
            </a>
            
            <a href="#tentang" class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 font-bold text-slate-300 border border-slate-600 rounded-full hover:bg-slate-800 hover:text-white transition-all w-full sm:w-auto">
                Pelajari Program
            </a>
        </div>

        <!-- Countdown Timer -->
        @if(isset($statusForm) && $statusForm->tanggal_tutup && $statusForm->status === 'Buka')
            @php
                $tutup = \Carbon\Carbon::parse($statusForm->tanggal_tutup);
                $isClosed = now()->gt($tutup);
            @endphp
            @if(!$isClosed)
            <div class="mt-12 max-w-2xl mx-auto animate-fade-up" style="animation-delay: 400ms;">
                <p class="text-slate-400 text-sm font-semibold tracking-widest uppercase mb-4">Pendaftaran Ditutup Dalam</p>
                <div class="flex justify-center gap-4 sm:gap-6 text-white" id="countdown-timer" data-target="{{ $tutup->format('Y-m-d\TH:i:s') }}">
                    <div class="flex flex-col items-center">
                        <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center text-2xl sm:text-4xl font-black border border-slate-700/50 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                            <span id="cd-days">--</span>
                        </div>
                        <span class="text-xs sm:text-sm text-slate-400 mt-2 font-medium">Hari</span>
                    </div>
                    <div class="text-2xl sm:text-4xl font-black text-slate-600 dark:text-slate-300 mt-2 sm:mt-4">:</div>
                    <div class="flex flex-col items-center">
                        <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center text-2xl sm:text-4xl font-black border border-slate-700/50 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                            <span id="cd-hours">--</span>
                        </div>
                        <span class="text-xs sm:text-sm text-slate-400 mt-2 font-medium">Jam</span>
                    </div>
                    <div class="text-2xl sm:text-4xl font-black text-slate-600 dark:text-slate-300 mt-2 sm:mt-4">:</div>
                    <div class="flex flex-col items-center">
                        <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center text-2xl sm:text-4xl font-black border border-slate-700/50 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                            <span id="cd-minutes">--</span>
                        </div>
                        <span class="text-xs sm:text-sm text-slate-400 mt-2 font-medium">Menit</span>
                    </div>
                    <div class="text-2xl sm:text-4xl font-black text-slate-600 dark:text-slate-300 mt-2 sm:mt-4 hidden sm:block">:</div>
                    <div class="flex flex-col items-center hidden sm:flex">
                        <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl w-16 h-16 sm:w-20 sm:h-20 flex justify-center items-center text-2xl sm:text-4xl font-black border border-slate-700/50 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                            <span id="cd-seconds">--</span>
                        </div>
                        <span class="text-xs sm:text-sm text-slate-400 mt-2 font-medium">Detik</span>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>
</div>

{{-- PRELINE STATS --}}
<div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto -mt-12 lg:-mt-32 relative z-20 animate-fade-up" style="animation-delay: 300ms;">
  <div class="grid grid-cols-3 gap-2 sm:gap-4 lg:gap-10">
    <!-- Stat 1 -->
    <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl lg:rounded-[2.5rem] p-3 sm:p-6 lg:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/50 flex flex-col items-center justify-center text-center hover:-translate-y-3 hover:shadow-[0_20px_50px_-12px_rgba(220,38,38,0.2)] transition-all duration-500 group relative overflow-hidden h-full">
      <div class="absolute -right-6 -top-6 w-20 h-20 lg:w-32 lg:h-32 bg-red-50 rounded-full mix-blend-multiply opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
      <div class="relative z-10 w-full flex flex-col items-center">
        <div class="inline-flex justify-center items-center w-10 h-10 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-red-100 to-rose-50 text-red-600 mb-2 lg:mb-6 group-hover:from-red-600 group-hover:to-rose-500 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500 shadow-inner group-hover:shadow-[0_0_30px_rgba(220,38,38,0.4)]">
          <i class="fas fa-user-friends text-lg lg:text-3xl"></i>
        </div>
        <h4 class="text-xl sm:text-4xl lg:text-6xl font-black text-slate-800 dark:text-white tracking-tighter mb-1 lg:mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-red-600 group-hover:to-rose-500 transition-colors">500+</h4>
        <p class="text-[8px] sm:text-xs lg:text-sm font-bold text-slate-400 uppercase tracking-widest leading-tight">Anggota Aktif</p>
      </div>
    </div>
    
    <!-- Stat 2 -->
    <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl lg:rounded-[2.5rem] p-3 sm:p-6 lg:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/50 flex flex-col items-center justify-center text-center hover:-translate-y-3 hover:shadow-[0_20px_50px_-12px_rgba(220,38,38,0.2)] transition-all duration-500 group relative overflow-hidden h-full">
      <div class="absolute -right-6 -top-6 w-20 h-20 lg:w-32 lg:h-32 bg-rose-50 rounded-full mix-blend-multiply opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
      <div class="relative z-10 w-full flex flex-col items-center">
        <div class="inline-flex justify-center items-center w-10 h-10 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-red-100 to-rose-50 text-rose-600 mb-2 lg:mb-6 group-hover:from-red-600 group-hover:to-rose-500 group-hover:text-white group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-inner group-hover:shadow-[0_0_30px_rgba(225,29,72,0.4)]">
          <i class="fas fa-id-badge text-lg lg:text-3xl"></i>
        </div>
        <h4 class="text-xl sm:text-4xl lg:text-6xl font-black text-slate-800 dark:text-white tracking-tighter mb-1 lg:mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-red-600 group-hover:to-rose-500 transition-colors">30+</h4>
        <p class="text-[8px] sm:text-xs lg:text-sm font-bold text-slate-400 uppercase tracking-widest leading-tight">Pengurus Utama</p>
      </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl lg:rounded-[2.5rem] p-3 sm:p-6 lg:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-white/50 flex flex-col items-center justify-center text-center hover:-translate-y-3 hover:shadow-[0_20px_50px_-12px_rgba(220,38,38,0.2)] transition-all duration-500 group relative overflow-hidden h-full">
      <div class="absolute -right-6 -top-6 w-20 h-20 lg:w-32 lg:h-32 bg-orange-50 rounded-full mix-blend-multiply opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
      <div class="relative z-10 w-full flex flex-col items-center">
        <div class="inline-flex justify-center items-center w-10 h-10 lg:w-20 lg:h-20 rounded-full bg-gradient-to-br from-red-100 to-rose-50 text-orange-500 mb-2 lg:mb-6 group-hover:from-red-600 group-hover:to-rose-500 group-hover:text-white group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500 shadow-inner group-hover:shadow-[0_0_30px_rgba(249,115,22,0.4)]">
          <i class="fas fa-calendar-check text-lg lg:text-3xl"></i>
        </div>
        <h4 class="text-xl sm:text-4xl lg:text-6xl font-black text-slate-800 dark:text-white tracking-tighter mb-1 lg:mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-red-600 group-hover:to-rose-500 transition-colors">2020</h4>
        <p class="text-[8px] sm:text-xs lg:text-sm font-bold text-slate-400 uppercase tracking-widest leading-tight">Tahun Berdiri</p>
      </div>
    </div>
  </div>
</div>

{{-- VISI MISI SECTION --}}
<div class="relative max-w-[85rem] px-4 py-6 sm:px-6 lg:px-8 lg:py-24 mx-auto overflow-hidden" id="visi-misi">
  <!-- Decorative background pattern -->
  <div class="absolute inset-0 z-0">
      <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-[0.02]"></div>
      <div class="absolute top-1/2 left-0 w-72 h-72 bg-red-50 rounded-full mix-blend-multiply opacity-70 blur-3xl -translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
      <div class="absolute top-1/2 right-0 w-72 h-72 bg-orange-50 rounded-full mix-blend-multiply opacity-70 blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
  </div>

  <div class="relative z-10">
      <!-- Title -->
      <div class="mx-auto text-center mb-8 lg:mb-20 max-w-2xl">
        <h2 class="text-xs font-bold text-red-600 tracking-[0.3em] uppercase mb-3">Arah Perjuangan</h2>
        <h2 class="text-3xl font-extrabold md:text-5xl text-slate-900 dark:text-white tracking-tight text-balance">Visi &amp; Misi</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-red-600 to-rose-400 mx-auto mt-3 sm:mt-6 rounded-full"></div>
      </div>
      
      <!-- Visi Block -->
      <div class="relative bg-white/80 dark:bg-slate-800/80 backdrop-blur-md shadow-xl rounded-2xl lg:rounded-[3rem] px-5 py-6 sm:p-10 lg:p-20 border border-white dark:border-slate-700 mx-auto max-w-4xl text-center mb-8 lg:mb-16 group hover:shadow-[0_30px_60px_-15px_rgba(220,38,38,0.15)] transition-all duration-700">
        <!-- Icon inside card (no floating/absolute) -->
        <div class="flex justify-center mb-3 sm:mb-6">
            <div class="bg-gradient-to-br from-red-600 to-rose-500 text-white flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl sm:rounded-3xl shadow-xl shadow-red-600/30 group-hover:-translate-y-1 group-hover:rotate-6 transition-all duration-500">
                <i class="fas fa-eye text-lg sm:text-2xl lg:text-3xl"></i>
            </div>
        </div>
        
        <div class="">
            <h3 class="text-slate-400 font-bold uppercase tracking-[0.2em] text-xs sm:text-sm mb-3 sm:mb-6">Visi Kami</h3>
            <p class="text-lg sm:text-3xl lg:text-4xl font-black text-slate-800 dark:text-white leading-tight tracking-tight px-2 sm:px-10">
              "Menciptakan iklim pendidikan informal yang <span class="relative inline-block"><span class="relative z-10 text-red-600 group-hover:text-rose-600 transition-colors">menjunjung tinggi</span><span class="absolute bottom-1 left-0 w-full h-3 lg:h-4 bg-red-100 -z-0 group-hover:bg-rose-100 transition-colors"></span></span> hak-hak anak."
            </p>
        </div>
      </div>

      <!-- Misi Grid -->
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-5 sm:mb-12">
            <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-slate-50 border border-slate-100">
                <i class="fas fa-bullseye text-red-500"></i>
                <h3 class="text-sm font-bold text-slate-600 dark:text-slate-300 uppercase tracking-widest">Misi Kami</h3>
            </div>
        </div>
        
        <div class="grid grid-cols-3 gap-2 sm:gap-6 lg:gap-8">
            <!-- Misi 1 -->
            <div class="bg-white rounded-xl lg:rounded-[2rem] p-3 sm:p-5 lg:p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-slate-50 hover:border-red-100 hover:-translate-y-2 hover:shadow-[0_20px_50px_-12px_rgba(220,38,38,0.15)] transition-all duration-500 group relative overflow-hidden">
              <div class="absolute -right-10 -top-10 w-32 h-32 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
              <div class="relative z-10 flex flex-col items-center sm:items-start text-center sm:text-left">
                  <div class="inline-flex justify-center items-center w-9 h-9 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-slate-50 text-slate-400 mb-2 sm:mb-6 group-hover:bg-red-50 group-hover:text-red-600 transition-colors duration-500">
                      <span class="text-sm sm:text-2xl font-black">01</span>
                  </div>
                  <h4 class="text-[11px] sm:text-xl font-bold text-slate-900 dark:text-white mb-0 sm:mb-4 group-hover:text-red-600 transition-colors duration-500 leading-tight">Wadah Pengembangan</h4>
                  <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-xs hidden sm:block">Memberikan wadah bagi anak-anak untuk mengembangkan karakter dan potensi yang dimiliki secara optimal.</p>
              </div>
            </div>
            
            <!-- Misi 2 -->
            <div class="bg-white rounded-xl lg:rounded-[2rem] p-3 sm:p-5 lg:p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-slate-50 hover:border-rose-100 hover:-translate-y-2 hover:shadow-[0_20px_50px_-12px_rgba(225,29,72,0.15)] transition-all duration-500 group relative overflow-hidden">
              <div class="absolute -right-10 -top-10 w-32 h-32 bg-rose-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
              <div class="relative z-10 flex flex-col items-center sm:items-start text-center sm:text-left">
                  <div class="inline-flex justify-center items-center w-9 h-9 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-slate-50 text-slate-400 mb-2 sm:mb-6 group-hover:bg-rose-50 group-hover:text-rose-600 transition-colors duration-500">
                      <span class="text-sm sm:text-2xl font-black">02</span>
                  </div>
                  <h4 class="text-[11px] sm:text-xl font-bold text-slate-900 dark:text-white mb-0 sm:mb-4 group-hover:text-rose-600 transition-colors duration-500 leading-tight">Kesadaran Masyarakat</h4>
                  <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-xs hidden sm:block">Meningkatkan kesadaran dan kepedulian masyarakat sekitar akan arti pentingnya pendidikan bagi masa depan.</p>
              </div>
            </div>

            <!-- Misi 3 -->
            <div class="bg-white rounded-xl lg:rounded-[2rem] p-3 sm:p-5 lg:p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-slate-50 hover:border-orange-100 hover:-translate-y-2 hover:shadow-[0_20px_50px_-12px_rgba(249,115,22,0.15)] transition-all duration-500 group relative overflow-hidden">
              <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
              <div class="relative z-10 flex flex-col items-center sm:items-start text-center sm:text-left">
                  <div class="inline-flex justify-center items-center w-9 h-9 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-slate-50 text-slate-400 mb-2 sm:mb-6 group-hover:bg-orange-50 group-hover:text-orange-600 transition-colors duration-500">
                      <span class="text-sm sm:text-2xl font-black">03</span>
                  </div>
                  <h4 class="text-[11px] sm:text-xl font-bold text-slate-900 dark:text-white mb-0 sm:mb-4 group-hover:text-orange-600 transition-colors duration-500 leading-tight">Ekosistem Pendidikan</h4>
                  <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-xs hidden sm:block">Menciptakan ekosistem komprehensif yang memberikan kebermanfaatan nyata bagi masyarakat di bidang pendidikan.</p>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

{{-- PRELINE FEATURE CARDS (CORE VALUES) --}}
<div class="max-w-[85rem] px-4 py-6 sm:px-6 lg:px-8 lg:py-24 mx-auto relative bg-slate-50 rounded-2xl lg:rounded-[4rem] mb-6 lg:mb-12" id="tentang">
  <!-- Decorative elements -->
  <div class="absolute inset-0 overflow-hidden rounded-[2rem] lg:rounded-[4rem]">
      <div class="absolute top-0 left-0 w-full h-full bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] bg-repeat opacity-[0.03]"></div>
      <div class="absolute -top-32 -right-32 w-96 h-96 bg-red-200/40 rounded-full mix-blend-multiply blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-rose-200/40 rounded-full mix-blend-multiply blur-3xl pointer-events-none"></div>
  </div>

  <!-- Title -->
  <div class="mx-auto text-center mb-6 lg:mb-16 max-w-2xl relative z-10">
    <h2 class="text-xs font-bold text-red-600 tracking-[0.3em] uppercase mb-4">Mengenal Lebih Dekat</h2>
    <h2 class="text-3xl font-extrabold md:text-5xl text-slate-900 dark:text-white tracking-tight text-balance">Core Values</h2>
    <div class="w-16 h-1.5 bg-gradient-to-r from-red-600 to-rose-400 mx-auto mt-6 rounded-full"></div>
    <p class="mt-3 sm:mt-6 text-sm sm:text-lg text-slate-500 dark:text-slate-400 text-balance">Nilai-nilai inti yang selalu kami pegang teguh demi menciptakan ekosistem yang cerdas dan mandiri.</p>
  </div>
  
  <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8 relative z-10">
    @php
        $values = [
            ['icon' => 'fa-shield-alt', 'title' => 'Integrity', 'desc' => 'Prinsip dasar yang tak tergoyahkan dalam setiap tindakan.', 'color' => 'from-emerald-400 to-teal-500', 'shadow' => 'shadow-emerald-500/30'],
            ['icon' => 'fa-bolt', 'title' => 'Proactive', 'desc' => 'Bertindak sigap jauh sebelum sebuah masalah muncul.', 'color' => 'from-amber-400 to-orange-500', 'shadow' => 'shadow-amber-500/30'],
            ['icon' => 'fa-handshake', 'title' => 'Belonging', 'desc' => 'Menjaga harmoni dan rasa saling memiliki dalam tiap detak komunitas.', 'color' => 'from-blue-400 to-indigo-500', 'shadow' => 'shadow-blue-500/30'],
            ['icon' => 'fa-heart', 'title' => 'Dedicated', 'desc' => 'Totalitas dan dedikasi penuh untuk masa depan anak Indonesia.', 'color' => 'from-red-400 to-rose-500', 'shadow' => 'shadow-red-500/30'],
            ['icon' => 'fa-dove', 'title' => 'Peaceful', 'desc' => 'Menciptakan ruang lingkup yang aman, rukun, dan damai.', 'color' => 'from-sky-400 to-cyan-500', 'shadow' => 'shadow-sky-500/30'],
            ['icon' => 'fa-rocket', 'title' => 'Forward', 'desc' => 'Bergerak maju menembus batas bersama inovasi tanpa henti.', 'color' => 'from-violet-400 to-purple-500', 'shadow' => 'shadow-violet-500/30'],
        ];
    @endphp
    @foreach($values as $index => $v)
    <!-- Card -->
    <div class="group h-full bg-white dark:bg-slate-800 rounded-xl lg:rounded-[2rem] p-3 lg:p-8 border border-white dark:border-slate-700 hover:border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 relative overflow-hidden flex flex-col items-center text-center">
      <!-- Hover Background Splash -->
      <div class="absolute inset-0 bg-gradient-to-br {{ $v['color'] }} opacity-0 group-hover:opacity-[0.03] transition-opacity duration-500 pointer-events-none"></div>
      
      <div class="relative z-10">
        <div class="inline-flex justify-center items-center w-10 h-10 lg:w-16 lg:h-16 rounded-xl lg:rounded-2xl bg-gradient-to-br {{ $v['color'] }} text-white mb-2 lg:mb-6 group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500 shadow-lg {{ $v['shadow'] }} mx-auto">
          <i class="fas {{ $v['icon'] }} text-base lg:text-2xl"></i>
        </div>
        <h3 class="block text-xs sm:text-base lg:text-2xl font-bold text-slate-800 dark:text-white tracking-tight mb-1 lg:mb-3 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:{{ $v['color'] }} transition-colors duration-300">{{ $v['title'] }}</h3>
        <p class="text-slate-500 dark:text-slate-400 leading-relaxed text-[10px] sm:text-xs lg:text-base hidden sm:block">{{ $v['desc'] }}</p>
      </div>
    </div>
    <!-- End Card -->
    @endforeach
  </div>
</div>

{{-- PRELINE TEAM (STRUKTUR ORGANISASI) --}}
@if(isset($pengurus) && $pengurus->count() > 0)
@php
    $bph = $pengurus->where('kategori', 'BPH')->values();
    $departments = $pengurus->where('kategori', 'Staff & Departemen')->values();
@endphp

<div x-data="{ 
        modalOpen: false, 
        selectedPerson: null,
        openModal(person) {
            this.selectedPerson = person;
            this.modalOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.modalOpen = false;
            setTimeout(() => this.selectedPerson = null, 300);
            document.body.classList.remove('overflow-hidden');
        }
    }" 
    class="max-w-[85rem] px-4 py-6 sm:px-6 lg:px-8 lg:py-24 mx-auto" id="struktur-organisasi">
    
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-5 lg:mb-16">
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-red-200 bg-red-50 text-red-600 mb-4">
        <i class="fas fa-users text-xs"></i>
        <span class="text-xs font-bold tracking-[0.2em] uppercase">Tim Kami</span>
    </div>
    <h2 class="text-2xl font-extrabold md:text-5xl md:leading-tight text-slate-900 dark:text-white tracking-tight text-balance">Struktur Kepengurusan</h2>
    <div class="w-16 h-1 bg-gradient-to-r from-red-600 to-rose-400 mx-auto mt-3 sm:mt-6 rounded-full"></div>
    <p class="mt-2 sm:mt-6 text-sm sm:text-lg text-slate-500 dark:text-slate-400 text-balance">Mengenal lebih dekat formasi kepengurusan Sekolah Rakyat Serdadu Kumbang.</p>
  </div>
  <!-- End Title -->

  <div class="space-y-8 lg:space-y-16">
    {{-- BADAN PENGURUS HARIAN (BPH) --}}
    @if($bph->count() > 0)
    <div>
        <div class="relative flex items-center justify-center w-full mb-6 lg:mb-12">
            <hr class="w-full h-px bg-gradient-to-r from-transparent via-red-300 to-transparent border-0">
            <span class="absolute px-5 py-1.5 text-xs font-bold text-white uppercase tracking-[0.2em] bg-gradient-to-r from-red-600 to-rose-500 rounded-full shadow-lg shadow-red-500/30">Badan Pengurus Harian</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 justify-items-center">
            @foreach($bph as $index => $member)
            <div @click="openModal({{ json_encode(['nama' => $member->nama, 'jabatan' => $member->jabatan, 'deskripsi' => $member->deskripsi, 'foto' => $member->foto ? asset('storage/' . $member->foto) : null]) }})" 
                 class="w-full max-w-sm cursor-pointer group relative overflow-hidden rounded-xl sm:rounded-[2rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 hover:border-red-100 dark:hover:border-red-900 premium-shadow hover:shadow-2xl hover:-translate-y-1 smooth-transition flex flex-col items-center text-center">
              
              <!-- Decorative BG -->
              <div class="absolute inset-0 bg-gradient-to-b from-red-50/50 to-transparent h-1l2 -z-10 group-hover:from-red-100/50 smooth-transition"></div>
              
              <div class="p-3 sm:p-8 w-full flex flex-col items-center">
                <div class="relative mb-2 sm:mb-6">
                  @if($member->foto)
                    <img class="size-16 sm:size-40 object-cover rounded-full mx-auto ring-2 sm:ring-4 ring-white shadow-lg group-hover:ring-red-50 smooth-transition" src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}">
                  @else
                    <div class="size-16 sm:size-40 rounded-full mx-auto bg-gradient-to-br from-red-100 to-rose-50 flex items-center justify-center text-red-400 text-2xl sm:text-5xl ring-2 sm:ring-4 ring-white shadow-lg"><i class="fas fa-user-tie"></i></div>
                  @endif
                  <div class="absolute bottom-0 right-0 sm:right-2 text-white size-7 sm:size-10 rounded-full flex items-center justify-center border-2 sm:border-4 border-white shadow-sm group-hover:scale-110 group-hover:rotate-12 smooth-transition {{ str_contains(strtolower($member->jabatan), 'ketua') ? 'bg-red-600' : (str_contains(strtolower($member->jabatan), 'wakil') ? 'bg-rose-500' : (str_contains(strtolower($member->jabatan), 'bendahara') ? 'bg-emerald-500' : (str_contains(strtolower($member->jabatan), 'sekretaris') ? 'bg-indigo-500' : 'bg-orange-400'))) }}">
                    <i class="fas {{ str_contains(strtolower($member->jabatan), 'ketua') ? 'fa-star' : (str_contains(strtolower($member->jabatan), 'wakil') ? 'fa-medal' : (str_contains(strtolower($member->jabatan), 'bendahara') ? 'fa-wallet text-[9px]' : (str_contains(strtolower($member->jabatan), 'sekretaris') ? 'fa-book text-[9px]' : 'fa-list-ul'))) }} text-[10px] sm:text-sm mt-0.5 leading-none"></i>
                  </div>
                </div>
                
                <h3 class="font-extrabold text-xs sm:text-2xl text-slate-800 dark:text-white tracking-tight mb-0.5 sm:mb-1 group-hover:text-red-600 smooth-transition leading-tight">{{ $member->nama }}</h3>
                <p class="text-[10px] sm:text-xs font-bold text-red-500 uppercase tracking-wider">{{ $member->jabatan }}</p>
              </div>
              
              <!-- Footer detail prompt -->
              <div class="w-full bg-slate-50 dark:bg-slate-700/50 py-2 sm:py-3 text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-widest group-hover:bg-red-50 group-hover:text-red-500 smooth-transition mt-auto">
                Lihat Profil <i class="fas fa-arrow-right ml-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 smooth-transition"></i>
              </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- STAFF & DEPARTEMEN --}}
    @if($departments->count() > 0)
    <div class="mt-12 lg:mt-24">
        <div class="relative flex items-center justify-center w-full mb-6 lg:mb-12">
            <hr class="w-full h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent border-0">
            <span class="absolute px-5 py-1.5 text-xs font-bold text-slate-500 uppercase tracking-[0.2em] bg-slate-100 rounded-full shadow-sm">Staff & Departemen</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 justify-items-center">
            @foreach($departments as $index => $member)
            <div @click="openModal({{ json_encode(['nama' => $member->nama, 'jabatan' => $member->jabatan, 'deskripsi' => $member->deskripsi, 'foto' => $member->foto ? asset('storage/' . $member->foto) : null]) }})" 
                 class="w-full max-w-xs cursor-pointer group relative overflow-hidden rounded-xl sm:rounded-[2rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 hover:border-slate-200 dark:hover:border-slate-600 shadow-sm hover:shadow-xl hover:-translate-y-1 smooth-transition flex flex-col items-center text-center">
              
              <!-- Decorative BG -->
              <div class="absolute inset-0 bg-gradient-to-b from-slate-50/50 to-transparent h-1/2 -z-10 group-hover:from-slate-100/50 smooth-transition"></div>

              <div class="p-3 sm:p-6 w-full flex flex-col items-center flex-grow">
                <div class="relative mb-3 sm:mb-5">
                  @if($member->foto)
                    <img class="size-14 sm:size-28 object-cover rounded-full mx-auto ring-2 sm:ring-4 ring-white shadow-md group-hover:ring-slate-50 smooth-transition" src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}">
                  @else
                    <div class="size-14 sm:size-28 rounded-full mx-auto bg-slate-50 flex items-center justify-center text-slate-300 text-2xl sm:text-4xl ring-2 sm:ring-4 ring-white shadow-md"><i class="fas fa-user-tie"></i></div>
                  @endif
                </div>
                
                <h3 class="font-extrabold text-xs sm:text-lg text-slate-800 dark:text-white tracking-tight mb-0.5 sm:mb-1 group-hover:text-slate-900 smooth-transition leading-tight">{{ $member->nama }}</h3>
                <p class="text-[9px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-wider">{{ $member->jabatan }}</p>
              </div>

              <!-- Footer detail prompt -->
              <div class="w-full bg-slate-50/50 dark:bg-slate-700/50 py-2 sm:py-2.5 text-[9px] sm:text-[11px] font-semibold text-slate-400 uppercase tracking-widest group-hover:bg-slate-100 group-hover:text-slate-600 smooth-transition mt-auto border-t border-slate-50">
                Lihat Profil <i class="fas fa-arrow-right ml-1 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 smooth-transition"></i>
              </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

  </div>

  {{-- Modal Popup --}}
  <div x-show="modalOpen" 
       class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/60 backdrop-blur-sm transition-opacity"
       x-transition:enter="ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       style="display: none;"
       @click.self="closeModal()">
      
      <div class="relative w-full max-w-lg p-4 sm:p-6 mx-auto"
           x-show="modalOpen"
           x-transition:enter="ease-out duration-300"
           x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
           x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave="ease-in duration-200"
           x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          
          <div class="relative bg-white dark:bg-slate-800 rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.25)] overflow-hidden flex flex-col transform transition-all" @click.stop>
              {{-- Header Image/Color --}}
              <div class="h-28 sm:h-32 bg-slate-50 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-700 relative overflow-hidden flex items-center justify-center">
                  <!-- Decorative elements -->
                  <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-[0.03]"></div>
                  
                  <button @click="closeModal()" type="button" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:text-slate-300 bg-white hover:bg-slate-100 rounded-full p-2.5 transition-colors z-10 shadow-sm border border-slate-200">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                  </button>
              </div>
              
              {{-- Body --}}
              <div class="px-6 sm:px-10 pb-10 -mt-14 sm:-mt-16 text-center relative z-10">
                  {{-- Photo --}}
                  <div class="relative inline-block w-28 h-28 sm:w-32 sm:h-32 rounded-full border-[4px] border-white shadow-lg bg-white overflow-hidden mb-5 group">
                      <template x-if="selectedPerson && selectedPerson.foto">
                          <img :src="selectedPerson.foto" :alt="selectedPerson.nama" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                      </template>
                      <template x-if="selectedPerson && !selectedPerson.foto">
                          <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300 text-5xl">
                              <i class="fas fa-user"></i>
                          </div>
                      </template>
                  </div>

                  <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight" x-text="selectedPerson ? selectedPerson.nama : ''"></h3>
                  
                  <div class="mt-1 mb-6">
                      <span class="text-slate-500 dark:text-slate-400 font-medium text-sm sm:text-base tracking-wide" x-text="selectedPerson ? selectedPerson.jabatan : ''"></span>
                  </div>
                  
                  <div class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed text-left max-h-60 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                      <template x-if="selectedPerson && selectedPerson.deskripsi">
                          <div x-html="selectedPerson.deskripsi" class="prose prose-sm sm:prose-base prose-slate max-w-none prose-p:leading-relaxed prose-a:text-red-600"></div>
                      </template>
                      <template x-if="selectedPerson && !selectedPerson.deskripsi">
                          <div class="flex flex-col items-center justify-center text-slate-400 py-4 opacity-60">
                              <p class="italic text-center text-sm">Tidak ada deskripsi tersedia.</p>
                          </div>
                      </template>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endif

{{-- PRELINE CLIENT/PARTNER LOGOS --}}
@if(isset($partners) && $partners->count() > 0)
<div class="max-w-[85rem] px-4 py-8 sm:px-6 lg:px-8 lg:py-24 mx-auto transition-colors duration-300" id="partners">
  <div class="bg-slate-50/80 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-800 rounded-[1.5rem] sm:rounded-[2.5rem] p-6 sm:p-12 shadow-sm relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-red-100/50 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-rose-100/50 rounded-full blur-3xl pointer-events-none"></div>
      
      <!-- Title -->
      <div class="relative z-10 mx-auto text-center mb-5 sm:mb-14">
        <h2 class="text-slate-400 font-bold tracking-[0.2em] uppercase text-xs sm:text-sm mb-3">Partner & Relasi SerdaduKumbang</h2>
        <div class="w-12 h-1 bg-gradient-to-r from-red-600 to-rose-400 mx-auto rounded-full"></div>
      </div>
      
      <!-- Grid -->
      <div class="relative z-10 flex justify-center flex-wrap items-center gap-6 sm:gap-10 lg:gap-16">
        @foreach($partners as $partner)
            @if($partner->link)
                <a href="{{ $partner->link }}" target="_blank" class="block group">
            @else
                <div class="block group cursor-default">
            @endif
                <div class="w-32 h-32 sm:w-36 sm:h-36 lg:w-44 lg:h-44 bg-white dark:bg-slate-700 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-600 flex items-center justify-center p-4 sm:p-5 lg:p-6 group-hover:shadow-xl group-hover:-translate-y-2 group-hover:border-red-100 transition-all duration-500">
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="w-full h-full object-contain filter grayscale opacity-50 group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-500">
                </div>
            @if($partner->link)
                </a>
            @else
                </div>
            @endif
        @endforeach
      </div>
  </div>
</div>
@endif

{{-- PRELINE CTA SECTION --}}
<div class="max-w-[85rem] px-4 py-8 sm:px-6 lg:px-8 lg:py-24 mx-auto mb-10">
  <div class="relative bg-slate-900 rounded-[2rem] lg:rounded-[4rem] p-6 sm:p-12 lg:p-24 text-center overflow-hidden shadow-2xl">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-l from-red-600/40 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-full bg-gradient-to-t from-rose-600/40 via-transparent to-transparent"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-red-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-70 pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-rose-500 rounded-full mix-blend-multiply filter blur-[128px] opacity-70 pointer-events-none"></div>
    </div>
    
    <div class="relative z-10">
      <!-- Badge -->
      <div class="inline-block bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-1.5 mb-3 sm:mb-6">
        <span class="text-xs sm:text-sm font-bold text-red-100 uppercase tracking-widest">Ayo Daftarkan Diri Anda</span>
      </div>

      <!-- Title -->
      <h2 class="text-2xl sm:text-5xl lg:text-6xl font-black md:leading-tight text-white tracking-tight mb-3 sm:mb-6">Siap Bergabung?</h2>
      <p class="text-sm sm:text-xl text-slate-300 max-w-2xl mx-auto text-balance mb-6 sm:mb-12 leading-relaxed">Pendaftaran sedang dibuka. Jadilah bagian dari keluarga besar penyelenggara visi utama kami untuk masa depan Indonesia.</p>
      <!-- End Title -->

      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a class="group relative inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 font-bold text-slate-900 dark:text-white bg-white rounded-full overflow-hidden transition-all hover:scale-105 hover:shadow-[0_0_40px_-10px_rgba(255,255,255,0.5)] w-full sm:w-auto" href="{{ route('pendaftaran') }}">
          <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-red-50 rounded-full group-hover:w-60 group-hover:h-56 opacity-100"></span>
          <span class="relative flex items-center gap-2">
              Daftar Sekarang
              <svg class="w-5 h-5 transition-transform group-hover:translate-x-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
          </span>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
    // Countdown Timer Logic
    document.addEventListener('DOMContentLoaded', function() {
        const timerElement = document.getElementById('countdown-timer');
        if (!timerElement) return;

        const targetDate = new Date(timerElement.dataset.target).getTime();

        function calculateTime() {
            const now = Date.now();
            const distance = targetDate - now;

            if (distance < 0) {
                if (window.countdownInterval) clearInterval(window.countdownInterval);
                timerElement.parentElement.style.display = 'none';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const elDays = document.getElementById('cd-days');
            if (elDays) {
                elDays.innerText = days.toString().padStart(2, '0');
                document.getElementById('cd-hours').innerText = hours.toString().padStart(2, '0');
                document.getElementById('cd-minutes').innerText = minutes.toString().padStart(2, '0');
                const cdSeconds = document.getElementById('cd-seconds');
                if (cdSeconds) cdSeconds.innerText = seconds.toString().padStart(2, '0');
            }
        }

        // Run immediately so no dashes are shown
        calculateTime();

        // Update every second
        window.countdownInterval = setInterval(calculateTime, 1000);

        // Re-sync immediately when user comes back to this tab
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) calculateTime();
        });
    });
</script>

@endsection