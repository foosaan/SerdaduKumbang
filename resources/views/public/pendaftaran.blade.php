@extends('layouts.public')

@section('title', 'Formulir Pendaftaran')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-10">

    {{-- HERO --}}
    <div class="relative bg-slate-900 rounded-[1.5rem] lg:rounded-[3rem] px-4 sm:px-8 py-7 lg:py-16 text-center overflow-hidden mb-6 sm:mb-10 shadow-2xl animate-fade-up">
        <!-- Decorative Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] bg-cover bg-center bg-no-repeat opacity-10 mix-blend-overlay"></div>
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-red-600/30 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-rose-600/20 rounded-full mix-blend-multiply blur-[80px] pointer-events-none"></div>
        </div>
        
        <div class="relative z-10">
            <span class="inline-flex items-center px-3 py-1 bg-red-500/10 backdrop-blur-md border border-red-500/30 rounded-full text-xs font-bold tracking-widest mb-3 sm:mb-6 text-red-200">
                <span class="relative flex h-2 w-2 mr-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
                OPEN RECRUITMENT
            </span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black mb-2 sm:mb-4 tracking-tight text-white text-balance">
                Formulir <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-rose-500">Pendaftaran</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto leading-relaxed text-balance">
                Mari bergandengan tangan untuk anak Indonesia. Isi formulir pendaftaran ini dengan data yang sebenar-benarnya.
            </p>
        </div>
    </div>

    {{-- STEP INDICATOR (Preline Style) --}}
    <div class="animate-fade-up" style="animation-delay: 100ms;">
        <ul class="relative flex flex-row gap-x-2 mb-12 w-full max-w-2xl mx-auto">
        @foreach([['label' => 'Data Diri', 'num' => 1], ['label' => 'Dokumen', 'num' => 2], ['label' => 'Pilihan Divisi', 'num' => 3]] as $step)
        <li class="step-item flex items-center gap-x-2 shrink basis-0 flex-1 group {{ $step['num'] == 1 ? 'active' : '' }}" id="stepIndicator{{ $step['num'] }}">
            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                <span class="step-circle size-8 sm:size-10 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full transition-all">
                    <span class="step-number">{{ $step['num'] }}</span>
                    <svg class="step-icon hidden shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </span>
                <span class="step-label ms-2 text-sm font-medium text-gray-800 transition-colors hidden sm:block">
                    {{ $step['label'] }}
                </span>
            </span>
            @if($step['num'] < 3)
            <div class="step-line w-full h-px flex-1 bg-gray-200 group-last:hidden ml-2 transition-colors duration-300" id="stepLine{{ $step['num'] }}"></div>
            @endif
        </li>
        @endforeach
    </ul>
    </div>

    {{-- ALERTS --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6">
        <div class="flex items-start gap-2">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <div>
                <p class="font-bold text-red-700 text-sm mb-1">Ada kesalahan:</p>
                <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white rounded-3xl premium-shadow border border-slate-100 p-6 sm:p-8 lg:p-12 animate-fade-up" style="animation-delay: 200ms;">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf

            {{-- ==================== STEP 1: DATA DIRI ==================== --}}
            <div class="step-panel active" id="step1">
                <div class="flex items-center gap-2 font-extrabold text-red-900 text-base sm:text-lg mb-6">
                    <i class="fas fa-user"></i> Data Diri
                    <div class="flex-grow h-0.5 bg-slate-100 ml-2 rounded"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2 md:grid md:grid-cols-3 md:gap-5">
                        <div class="md:col-span-2 mb-5 md:mb-0">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('nama_lengkap') !border-red-500 @enderror" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap Anda">
                            @error('nama_lengkap')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('jenis_kelamin') !border-red-500 @enderror">
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"><i class="fas fa-envelope mr-1 text-slate-400"></i> Email Aktif <span class="text-red-500">*</span></label>
                        <input type="email" name="email" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('email') !border-red-500 @enderror" value="{{ old('email') }}" placeholder="contoh@email.com">
                        @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"><i class="fab fa-whatsapp mr-1 text-emerald-500"></i> Nomor WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('no_hp') !border-red-500 @enderror" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                        @error('no_hp')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"><i class="fas fa-building mr-1 text-slate-400"></i> Asal Instansi <span class="text-red-500">*</span></label>
                        <input type="text" name="asal_instansi" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('asal_instansi') !border-red-500 @enderror" value="{{ old('asal_instansi') }}" placeholder='Nama instansi atau isi "independent"'>
                        @error('asal_instansi')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"><i class="fas fa-calendar mr-1 text-slate-400"></i> Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('tanggal_lahir') !border-red-500 @enderror" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2"><i class="fas fa-map-marker-alt mr-1 text-slate-400"></i> Alamat di Yogyakarta <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('alamat') !border-red-500 @enderror" placeholder="Jl. ... RT/RW, Kelurahan, Kecamatan">{{ old('alamat') }}</textarea>
                        @error('alamat')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="button" class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none transition-all" onclick="goToStep(2)">
                        Selanjutnya
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

            {{-- ==================== STEP 2: DOKUMEN ==================== --}}
            <div class="step-panel hidden" id="step2">
                <div class="flex items-center gap-2 font-extrabold text-red-900 text-base sm:text-lg mb-6">
                    <i class="fas fa-file-alt"></i> Pengumpulan Dokumen
                    <div class="flex-grow h-0.5 bg-slate-100 ml-2 rounded"></div>
                </div>

                <div class="flex items-center gap-3 px-4 py-3 bg-blue-50 border-l-4 border-blue-500 rounded-xl mb-6">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    <p class="text-sm text-blue-700 font-medium">Semua file maksimal <strong>10MB</strong>. Format: PDF.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- CV --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">📄 CV <span class="text-red-500">*</span></label>
                        <div class="file-upload-area border-2 border-dashed border-slate-300 rounded-2xl p-6 bg-slate-50 hover:border-red-400 hover:bg-red-50/30 cursor-pointer text-center smooth-transition hover:-translate-y-1" id="cvArea" onclick="document.getElementById('cv').click()">
                            <i class="fas fa-cloud-upload-alt text-3xl text-slate-300 mb-2 block group-hover:text-red-400 smooth-transition"></i>
                            <p class="text-xs text-slate-400">Klik untuk upload CV</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-slate-100 text-xs text-slate-500 dark:text-slate-400 rounded">Format: CV_NamaLengkap</span>
                            <p class="file-name text-xs text-emerald-600 font-semibold mt-2" id="cvName"></p>
                        </div>
                        <input type="file" name="cv" id="cv" class="hidden" accept=".pdf" onchange="showFileName(this, 'cvName', 'cvArea')">
                        @error('cv')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Follow IG --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">📸 Bukti Follow Instagram <span class="text-red-500">*</span></label>
                        <div class="file-upload-area border-2 border-dashed border-slate-300 rounded-2xl p-6 bg-slate-50 hover:border-red-400 hover:bg-red-50/30 cursor-pointer text-center smooth-transition hover:-translate-y-1" id="igArea" onclick="document.getElementById('follow_ig').click()">
                            <i class="fab fa-instagram text-3xl text-slate-300 mb-2 block group-hover:text-red-400 smooth-transition"></i>
                            <p class="text-xs text-slate-400">@sr_serdadukumbang</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-slate-100 text-xs text-slate-500 dark:text-slate-400 rounded">Format: Follow IG_NamaLengkap</span>
                            <p class="file-name text-xs text-emerald-600 font-semibold mt-2" id="igName"></p>
                        </div>
                        <input type="file" name="follow_ig" id="follow_ig" class="hidden" accept=".pdf" onchange="showFileName(this, 'igName', 'igArea')">
                        @error('follow_ig')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Follow TikTok --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">🎵 Bukti Follow TikTok <span class="text-red-500">*</span></label>
                        <div class="file-upload-area border-2 border-dashed border-slate-300 rounded-2xl p-6 bg-slate-50 hover:border-red-400 hover:bg-red-50/30 cursor-pointer text-center smooth-transition hover:-translate-y-1" id="ttArea" onclick="document.getElementById('follow_tiktok').click()">
                            <i class="fab fa-tiktok text-3xl text-slate-300 mb-2 block group-hover:text-red-400 smooth-transition"></i>
                            <p class="text-xs text-slate-400">@sr_serdadukumbang</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-slate-100 text-xs text-slate-500 dark:text-slate-400 rounded">Format: Follow Tiktok_NamaLengkap</span>
                            <p class="file-name text-xs text-emerald-600 font-semibold mt-2" id="ttName"></p>
                        </div>
                        <input type="file" name="follow_tiktok" id="follow_tiktok" class="hidden" accept=".pdf" onchange="showFileName(this, 'ttName', 'ttArea')">
                        @error('follow_tiktok')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Portofolio --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">🎨 Portofolio Desain <span class="text-slate-400 font-normal text-xs">(wajib jika pilih Media Branding)</span></label>
                        <div class="file-upload-area border-2 border-dashed border-slate-300 rounded-2xl p-6 bg-slate-50 hover:border-red-400 hover:bg-red-50/30 cursor-pointer text-center smooth-transition hover:-translate-y-1" id="portArea" onclick="document.getElementById('portofolio').click()">
                            <i class="fas fa-palette text-3xl text-slate-300 mb-2 block group-hover:text-red-400 smooth-transition"></i>
                            <p class="text-xs text-slate-400">Klik untuk upload portofolio</p>
                            <span class="inline-block mt-2 px-2 py-1 bg-slate-100 text-xs text-slate-500 dark:text-slate-400 rounded">Opsional (wajib Media Branding)</span>
                            <p class="file-name text-xs text-emerald-600 font-semibold mt-2" id="portName"></p>
                        </div>
                        <input type="file" name="portofolio" id="portofolio" class="hidden" accept=".pdf" onchange="showFileName(this, 'portName', 'portArea')">
                        @error('portofolio')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-between gap-x-2">
                    <button type="button" class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-all" onclick="goToStep(1)">
                        <i class="fas fa-chevron-left text-xs"></i>
                        Kembali
                    </button>
                    <button type="button" class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none transition-all" onclick="goToStep(3)">
                        Selanjutnya
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

            {{-- ==================== STEP 3: PILIHAN DIVISI ==================== --}}
            <div class="step-panel hidden" id="step3">
                <div class="flex items-center gap-2 font-extrabold text-red-900 text-base sm:text-lg mb-6">
                    <i class="fas fa-users"></i> Pilihan Divisi
                    <div class="flex-grow h-0.5 bg-slate-100 ml-2 rounded"></div>
                </div>

                <div class="space-y-6">
                    {{-- Sumber Info --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3">Dari mana kamu tahu tentang Serdadu Kumbang? <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $sumberOptions = ['Instagram', 'TikTok', 'WhatsApp', 'Teman', 'Website', 'Lainnya'];
                                $oldSumber = old('sumber_info', '');
                            @endphp
                            @foreach($sumberOptions as $opt)
                            <label class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-50 border border-transparent rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-200 smooth-transition text-sm font-medium">
                                <input type="checkbox" class="sumber-checkbox rounded border-slate-300 text-red-600 focus:ring-red-500" value="{{ $opt }}" {{ str_contains($oldSumber, $opt) ? 'checked' : '' }}>
                                <span>{{ $opt }}</span>
                            </label>
                            @endforeach
                        </div>
                        <input type="hidden" name="sumber_info" id="sumberInfoHidden" value="{{ old('sumber_info') }}">
                        @error('sumber_info')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Motivasi --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Motivasi Bergabung <span class="text-red-500">*</span></label>
                        <textarea name="motivasi" rows="4" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('motivasi') !border-red-500 @enderror" placeholder="Ceritakan motivasi kamu untuk bergabung dengan Serdadu Kumbang...">{{ old('motivasi') }}</textarea>
                        @error('motivasi')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    @php
                        $divisiList = [
                            'Community Management',
                            'Curriculum',
                            'Program Relation and Development',
                            'Fundraising',
                            'Media Branding',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Pilihan Divisi 1 (Utama) <span class="text-red-500">*</span></label>
                            <select name="pilihan_1" id="pilihan1" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('pilihan_1') !border-red-500 @enderror">
                                <option value="" disabled {{ old('pilihan_1') ? '' : 'selected' }}>Pilih divisi utama</option>
                                @foreach($divisiList as $d)
                                <option value="{{ $d }}" {{ old('pilihan_1') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                            @error('pilihan_1')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Alasan Pilihan 1 <span class="text-red-500">*</span></label>
                            <textarea name="alasan_1" rows="3" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('alasan_1') !border-red-500 @enderror" placeholder="Mengapa kamu memilih divisi ini?">{{ old('alasan_1') }}</textarea>
                            @error('alasan_1')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Pilihan Divisi 2 (Cadangan) <span class="text-red-500">*</span></label>
                            <select name="pilihan_2" id="pilihan2" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('pilihan_2') !border-red-500 @enderror">
                                <option value="" disabled {{ old('pilihan_2') ? '' : 'selected' }}>Pilih divisi cadangan</option>
                                @foreach($divisiList as $d)
                                <option value="{{ $d }}" {{ old('pilihan_2') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                            @error('pilihan_2')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2">Alasan Pilihan 2 <span class="text-red-500">*</span></label>
                            <textarea name="alasan_2" rows="3" class="w-full border-2 border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:border-red-500 focus:ring-red-500/10 smooth-transition @error('alasan_2') !border-red-500 @enderror" placeholder="Mengapa kamu memilih divisi ini sebagai cadangan?">{{ old('alasan_2') }}</textarea>
                            @error('alasan_2')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Bersedia Divisi Lain --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3">Apakah kamu bersedia ditempatkan di divisi lain? <span class="text-red-500">*</span></label>
                        <div class="flex gap-3">
                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-transparent rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-200 smooth-transition text-sm font-medium">
                                <input type="radio" name="bersedia_divisi_lain" value="ya" class="text-red-600 focus:ring-red-500" {{ old('bersedia_divisi_lain') == 'ya' ? 'checked' : '' }}>
                                <span>✅ Ya, Bersedia</span>
                            </label>
                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-transparent rounded-xl cursor-pointer hover:bg-red-50 hover:border-red-200 smooth-transition text-sm font-medium">
                                <input type="radio" name="bersedia_divisi_lain" value="tidak" class="text-red-600 focus:ring-red-500" {{ old('bersedia_divisi_lain') == 'tidak' ? 'checked' : '' }}>
                                <span>❌ Tidak</span>
                            </label>
                        </div>
                        @error('bersedia_divisi_lain')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-between gap-x-2">
                    <button type="button" class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-all" onclick="goToStep(2)">
                        <i class="fas fa-chevron-left text-xs"></i>
                        Kembali
                    </button>
                    <button type="submit" class="py-3 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 shadow-md shadow-red-600/30 disabled:opacity-50 disabled:pointer-events-none transition-all" id="submitBtn">
                        Kirim Pendaftaran
                        <i class="fas fa-paper-plane text-xs"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

@push('styles')
<style>
    .step-panel { display: none; animation: fadeIn 0.4s ease; }
    .step-panel.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Preline Stepper Visual overrides managed by JS classes */
    .step-item.active .step-circle { background-color: #dc2626; color: white; }
    .step-item.active .step-label { color: #dc2626; font-weight: 700; }
    
    .step-item.completed .step-circle { background-color: #10b981; color: white; }
    .step-item.completed .step-icon { display: block; }
    .step-item.completed .step-number { display: none; }
    .step-item.completed .step-label { color: #334155; }
    
    .step-line.completed { background-color: #10b981; }
    .step-line.active { background: linear-gradient(90deg, #dc2626, #e5e7eb); }
    
    .file-upload-area.has-file { border-color: #10b981 !important; background-color: #f0fdf4 !important; }
    .file-upload-area.has-file i { color: #10b981 !important; }
</style>
@endpush

@push('scripts')
<script>
    let currentStep = 1;

    @if($errors->any())
        @if($errors->has('sumber_info') || $errors->has('motivasi') || $errors->has('pilihan_1') || $errors->has('alasan_1') || $errors->has('pilihan_2') || $errors->has('alasan_2') || $errors->has('bersedia_divisi_lain'))
            currentStep = 3;
        @elseif($errors->has('cv') || $errors->has('follow_ig') || $errors->has('follow_tiktok') || $errors->has('portofolio'))
            currentStep = 2;
        @else
            currentStep = 1;
        @endif
        goToStep(currentStep);
    @endif

    function goToStep(step) {
        if (step > currentStep) {
            if (!validateStep(currentStep)) return;
        }

        document.querySelectorAll('.step-panel').forEach(p => { p.classList.remove('active'); p.style.display = 'none'; });
        const target = document.getElementById('step' + step);
        target.style.display = 'block';
        target.classList.add('active');

        for (let i = 1; i <= 3; i++) {
            const ind = document.getElementById('stepIndicator' + i);
            ind.classList.remove('active', 'completed');
            if (i < step) ind.classList.add('completed');
            if (i === step) ind.classList.add('active');
        }

        for (let i = 1; i <= 2; i++) {
            const line = document.getElementById('stepLine' + i);
            line.classList.remove('completed', 'active');
            if (i < step) line.classList.add('completed');
            if (i === step) line.classList.add('active');
        }

        currentStep = step;
        window.scrollTo({ top: 200, behavior: 'smooth' });
    }

    function validateStep(step) {
        if (step === 1) {
            const fields = ['nama_lengkap', 'jenis_kelamin', 'email', 'no_hp', 'asal_instansi', 'tanggal_lahir', 'alamat'];
            let valid = true;
            fields.forEach(name => {
                const el = document.querySelector(`[name="${name}"]`);
                if (el && !el.value.trim()) {
                    el.classList.add('!border-red-500');
                    valid = false;
                } else if (el) {
                    el.classList.remove('!border-red-500');
                }
            });
            if (!valid) showAlert('Mohon lengkapi semua data diri terlebih dahulu.');
            return valid;
        }
        if (step === 2) {
            let valid = true;
            ['cv', 'follow_ig', 'follow_tiktok'].forEach(id => {
                const el = document.getElementById(id);
                const area = document.getElementById(id === 'cv' ? 'cvArea' : id === 'follow_ig' ? 'igArea' : 'ttArea');
                if (!el.files || !el.files.length) {
                    area.style.borderColor = '#dc2626';
                    valid = false;
                } else {
                    area.style.borderColor = '';
                }
            });
            if (!valid) showAlert('Mohon upload CV, bukti follow Instagram, dan bukti follow TikTok.');
            return valid;
        }
        return true;
    }

    function showAlert(msg) {
        const existing = document.querySelector('.step-alert');
        if (existing) existing.remove();
        const div = document.createElement('div');
        div.className = 'step-alert flex items-center gap-2 p-4 mb-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-700';
        div.innerHTML = '<i class="fas fa-exclamation-triangle"></i>' + msg;
        const form = document.getElementById('registrationForm');
        form.insertBefore(div, form.firstChild);
        setTimeout(() => div.remove(), 4000);
    }

    function showFileName(input, nameId, areaId) {
        const nameEl = document.getElementById(nameId);
        const areaEl = document.getElementById(areaId);
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file maksimal 10MB!');
                input.value = '';
                return;
            }
            nameEl.textContent = '✅ ' + file.name;
            areaEl.classList.add('has-file');
        }
    }

    document.querySelectorAll('.sumber-checkbox').forEach(cb => {
        cb.addEventListener('change', () => {
            const checked = [...document.querySelectorAll('.sumber-checkbox:checked')].map(c => c.value);
            document.getElementById('sumberInfoHidden').value = checked.join(', ');
        });
    });

    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const btn = document.getElementById('submitBtn');
        const originalBtnHTML = btn.innerHTML;

        // Check total file size before submitting (max 40MB)
        const fileInputs = form.querySelectorAll('input[type="file"]');
        let totalSize = 0;
        fileInputs.forEach(input => {
            if (input.files && input.files[0]) {
                totalSize += input.files[0].size;
            }
        });

        const maxTotal = 40 * 1024 * 1024; // 40MB
        if (totalSize > maxTotal) {
            showAlert('Total ukuran file terlalu besar (maks 40MB). Coba kompres file PDF kamu terlebih dahulu.');
            return;
        }

        // Check individual file sizes (max 10MB each)
        let oversizedFile = false;
        fileInputs.forEach(input => {
            if (input.files && input.files[0] && input.files[0].size > 10 * 1024 * 1024) {
                oversizedFile = true;
            }
        });
        if (oversizedFile) {
            showAlert('Ada file yang melebihi 10MB. Coba kompres file PDF kamu terlebih dahulu.');
            return;
        }

        // Disable button & show spinner
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

        // Use fetch with timeout for better Chrome iOS compatibility
        const formData = new FormData(form);
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 90000); // 90s timeout

        fetch(form.action, {
            method: 'POST',
            body: formData,
            signal: controller.signal,
            redirect: 'follow',
        })
        .then(response => {
            clearTimeout(timeoutId);
            return response.text().then(html => {
                if (response.ok) {
                    // Success or validation redirect — render the response
                    document.open();
                    document.write(html);
                    document.close();
                } else if (response.status === 419) {
                    btn.disabled = false;
                    btn.innerHTML = originalBtnHTML;
                    showAlert('Sesi telah habis. Silakan refresh halaman (tarik ke bawah) lalu coba lagi.');
                } else if (response.status === 422) {
                    // Validation errors — render error page
                    document.open();
                    document.write(html);
                    document.close();
                } else {
                    btn.disabled = false;
                    btn.innerHTML = originalBtnHTML;
                    showAlert('Terjadi kesalahan (kode ' + response.status + '). Silakan coba lagi.');
                }
            });
        })
        .catch(error => {
            clearTimeout(timeoutId);
            btn.disabled = false;
            btn.innerHTML = originalBtnHTML;
            if (error.name === 'AbortError') {
                showAlert('Pengiriman terlalu lama (timeout). Periksa koneksi internet kamu dan coba lagi.');
            } else {
                showAlert('Gagal mengirim data. Periksa koneksi internet kamu dan coba lagi.');
            }
            console.error('Submit error:', error);
        });
    });
</script>
@endpush

@endsection