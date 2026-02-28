@extends('layouts.public')

@section('title', 'Tutorial Pendaftaran — SerdaduKumbang')

@section('content')
<div class="bg-slate-50 dark:bg-slate-900 py-16 sm:py-24 overflow-hidden relative">
    
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-96 bg-red-600/5 dark:bg-red-500/5 -skew-y-3 origin-top-left -z-10"></div>
    <div class="absolute top-1/2 right-0 w-96 h-96 bg-blue-600/5 dark:bg-blue-500/5 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
            <h2 class="text-base font-bold text-red-600 tracking-wider uppercase mb-2">Panduan Pengguna</h2>
            <p class="mt-2 text-3xl leading-tight font-extrabold text-slate-900 dark:text-white sm:text-4xl lg:text-5xl">
                Cara Mendaftar di <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800 dark:from-red-400 dark:to-red-600">SerdaduKumbang</span>
            </p>
            <p class="mt-6 max-w-2xl text-lg text-slate-500 dark:text-slate-400 mx-auto">
                Berikut adalah panduan lengkap tahap demi tahap untuk memandu Anda mengisi formulir pendaftaran melalui website ini secara benar.
            </p>
        </div>

        <!-- Vertical Timeline -->
        <div class="relative">
            <!-- Central Line -->
            <div class="hidden md:block absolute left-1/2 top-0 w-1 h-full bg-gradient-to-b from-red-100 via-red-200 to-slate-100 dark:from-slate-700 dark:via-red-900/30 dark:to-slate-800 -translate-x-1/2 rounded-full"></div>

            <!-- STEP 1 -->
            <div class="relative flex flex-col md:flex-row justify-between items-center mb-16 md:mb-24 group" data-aos="fade-up">
                <div class="md:w-5/12 mb-8 md:mb-0 md:text-right pr-0 md:pr-12">
                    <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 font-bold text-sm mb-4">
                        TAHAP 1
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Isi Data Diri Terlebih Dahulu</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Klik tombol <strong>Daftar Sekarang</strong> di menu atas. Pada halaman pendaftaran tahap 1, isi seluruh informasi pribadi Anda:
                    </p>
                    <ul class="text-left md:text-right text-sm text-slate-500 dark:text-slate-400 space-y-2 mb-4 list-inside">
                        <li><i class="fas fa-check text-green-500 mr-1 md:ml-1 md:mr-0 order-last"></i> Nama Lengkap & Jenis Kelamin</li>
                        <li><i class="fas fa-check text-green-500 mr-1 md:ml-1 md:mr-0 order-last"></i> Email Aktif & Nomor WhatsApp</li>
                        <li><i class="fas fa-check text-green-500 mr-1 md:ml-1 md:mr-0 order-last"></i> Asal Instansi & Tanggal Lahir</li>
                        <li><i class="fas fa-check text-green-500 mr-1 md:ml-1 md:mr-0 order-last"></i> Alamat di Yogyakarta</li>
                    </ul>
                    <p class="text-xs text-red-500 font-medium italic">*Pastikan email benar karena akan digunakan untuk akses Dashboard.</p>
                </div>
                
                <div class="absolute left-1/2 top-0 md:top-1/2 -translate-x-1/2 md:-translate-y-1/2 w-12 h-12 bg-white dark:bg-slate-800 border-4 border-red-200 dark:border-slate-700 rounded-full flex items-center justify-center z-10 shadow-lg group-hover:border-red-500 transition-colors duration-300">
                    <span class="text-red-600 font-bold text-lg">1</span>
                </div>

                <div class="md:w-5/12 pl-0 md:pl-12 w-full">
                    <div class="bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform transition duration-500 hover:scale-105">
                        <img src="{{ asset('images/tutorial-step1.png') }}" class="w-full h-auto rounded-xl bg-slate-50 dark:bg-slate-900/50" alt="Step 1: Data Diri">
                    </div>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="relative flex flex-col md:flex-row-reverse justify-between items-center mb-16 md:mb-24 group" data-aos="fade-up">
                <div class="md:w-5/12 mb-8 md:mb-0 md:text-left pl-0 md:pl-12">
                    <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 font-bold text-sm mb-4">
                        TAHAP 2
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Unggah Dokumen Penting</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Setelah menekan tombol "Selanjutnya", Anda akan diarahkan ke tahap pengumpulan dokumen pendukung. Anda wajib menyiapkan dan mengunggah:
                    </p>
                    <ul class="text-left text-sm text-slate-500 dark:text-slate-400 space-y-2 mb-4">
                        <li><i class="fas fa-file-pdf text-red-500 mr-2 w-4"></i> <strong>CV</strong> (Wajib, format PDF, maks 10MB)</li>
                        <li><i class="fab fa-instagram text-pink-500 mr-2 w-4"></i> <strong>Bukti Follow Instagram</strong> @sr_serdadukumbang (Wajib)</li>
                        <li><i class="fab fa-tiktok text-slate-900 dark:text-slate-300 mr-2 w-4"></i> <strong>Bukti Follow TikTok</strong> @sr_serdadukumbang (Wajib)</li>
                        <li><i class="fas fa-palette text-blue-500 mr-2 w-4"></i> <strong>Portofolio Desain</strong> (Wajib jika pilih Media Branding)</li>
                    </ul>
                </div>
                
                <div class="absolute left-1/2 top-0 md:top-1/2 -translate-x-1/2 md:-translate-y-1/2 w-12 h-12 bg-white dark:bg-slate-800 border-4 border-red-200 dark:border-slate-700 rounded-full flex items-center justify-center z-10 shadow-lg group-hover:border-red-500 transition-colors duration-300">
                    <span class="text-red-600 font-bold text-lg">2</span>
                </div>

                <div class="md:w-5/12 pr-0 md:pr-12 w-full">
                    <div class="bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform transition duration-500 hover:scale-105">
                        <img src="{{ asset('images/tutorial-step2.png') }}" class="w-full h-auto rounded-xl bg-slate-50 dark:bg-slate-900/50" alt="Step 2: Upload Dokumen">
                    </div>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="relative flex flex-col md:flex-row justify-between items-center mb-16 md:mb-24 group" data-aos="fade-up">
                <div class="md:w-5/12 mb-8 md:mb-0 md:text-right pr-0 md:pr-12">
                    <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 font-bold text-sm mb-4">
                        TAHAP 3
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Tentukan Pilihan Divisi</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                        Tahap terakhir adalah memilih tempat Anda berkarya. Pada website ini, Anda dapat memilih hingga dua posisi:
                    </p>
                    <ul class="text-left md:text-right text-sm text-slate-500 dark:text-slate-400 space-y-2 mb-4">
                        <li><strong>Motivasi Bergabung</strong> & <strong>Sumber Info</strong> <i class="fas fa-lightbulb text-yellow-500 ml-1"></i></li>
                        <li><strong>Pilihan Divisi 1 (Utama)</strong> beserta alasannya <i class="fas fa-star text-yellow-500 ml-1"></i></li>
                        <li><strong>Pilihan Divisi 2 (Cadangan)</strong> beserta alasannya <i class="fas fa-star-half-alt text-yellow-500 ml-1"></i></li>
                        <li><strong>Kesediaan Ditempatkan di Divisi Lain</strong> <i class="fas fa-random text-blue-500 ml-1"></i></li>
                    </ul>
                    <p class="text-xs text-slate-500 font-medium italic">Pastikan seluruh data sudah benar sebelum menekan tombol "Kirim Pendaftaran".</p>
                </div>
                
                <div class="absolute left-1/2 top-0 md:top-1/2 -translate-x-1/2 md:-translate-y-1/2 w-12 h-12 bg-white dark:bg-slate-800 border-4 border-red-200 dark:border-slate-700 rounded-full flex items-center justify-center z-10 shadow-lg group-hover:border-red-500 transition-colors duration-300">
                    <span class="text-red-600 font-bold text-lg">3</span>
                </div>

                <div class="md:w-5/12 pl-0 md:pl-12 w-full">
                    <div class="bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform transition duration-500 hover:scale-105">
                        <img src="{{ asset('images/tutorial-step3.png') }}" class="w-full h-auto rounded-xl bg-slate-50 dark:bg-slate-900/50" alt="Step 3: Pilihan Divisi">
                    </div>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="relative flex flex-col md:flex-row-reverse justify-between items-center group" data-aos="fade-up">
                <div class="md:w-5/12 mb-8 md:mb-0 md:text-left pl-0 md:pl-12">
                    <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 font-bold text-sm mb-4">
                        SELESAI
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Pantau Dashboard Akun Anda</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed overflow-hidden">
                        Setelah Form berhasil dikirim, Anda akan langsung mendapatkan akun! Proses selanjutnya:
                    </p>
                    <ul class="text-left text-sm text-slate-500 dark:text-slate-400 space-y-3 mt-4">
                        <li class="flex items-start">
                            <i class="fas fa-sign-in-alt text-emerald-500 mt-1 mr-3"></i>
                            <span>Menu <a href="{{ route('login') }}" class="text-red-600 hover:underline">Login</a> dengan email dan password yang baru saja Anda buat.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-emerald-500 mt-1 mr-3"></i>
                            <span>Cek menu "Status Pendaftaran" di Dashboard Anda secara berkala untuk melihat pengumuman kelulusan.</span>
                        </li>
                    </ul>
                </div>
                
                <div class="absolute left-1/2 top-0 md:top-1/2 -translate-x-1/2 md:-translate-y-1/2 w-12 h-12 bg-emerald-500 border-4 border-emerald-200 dark:border-emerald-800 rounded-full flex items-center justify-center z-10 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-check text-white font-bold text-lg"></i>
                </div>

                <div class="md:w-5/12 pr-0 md:pr-12 w-full">
                    <div class="bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 transform transition duration-500 hover:scale-105">
                        <img src="{{ asset('images/tutorial-step4.png') }}" class="w-full h-auto rounded-xl bg-slate-50 dark:bg-slate-900/50" alt="Step 4: Status Dashboard">
                    </div>
                </div>
            </div>

        </div> <!-- End Timeline -->

        <div class="mt-24 text-center pb-10" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Sudah Paham Tahapannya?</h3>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('pendaftaran') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-600/30 transform hover:-translate-y-1 transition-all duration-300">
                    Mulai Daftar Sekarang <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-white dark:bg-slate-800 text-slate-700 dark:text-white border-2 border-slate-200 dark:border-slate-700 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300">
                    Login ke Dashboard <i class="fas fa-user-circle"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
