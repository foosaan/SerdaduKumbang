@extends('layouts.public')

@section('title', 'Tutorial Pendaftaran — SerdaduKumbang')

@section('content')
<div class="bg-slate-50 py-12 sm:py-20 relative">
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-sm font-bold text-red-600 tracking-wider uppercase mb-2">Panduan Pengguna</h2>
            <p class="mt-2 text-2xl sm:text-4xl font-extrabold text-slate-900">
                Cara Mendaftar di <br class="hidden sm:block" />
                <span class="text-red-700">SerdaduKumbang</span>
            </p>
            <p class="mt-4 text-base text-slate-500 mx-auto max-w-2xl">
                Berikut adalah panduan lengkap tahap demi tahap untuk memandu Anda mengisi formulir pendaftaran melalui website ini secara benar.
            </p>
        </div>

        <!-- Simple Stacked Layout -->
        <div class="space-y-8">

            <!-- STEP 1 -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden flex flex-col sm:flex-row group" data-aos="fade-up">
                <div class="sm:w-1/2 p-6 sm:p-8 flex flex-col justify-center">
                    <div class="inline-flex max-w-max items-center justify-center px-4 py-1.5 rounded-full bg-red-100 text-red-600 font-bold text-xs mb-4">
                        TAHAP 1
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Isi Data Diri Terlebih Dahulu</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Klik tombol <strong>Daftar Sekarang</strong> di menu atas. Pada halaman pendaftaran tahap 1, isi seluruh informasi pribadi Anda:
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2 mb-4">
                        <li><i class="fas fa-check text-green-500 mr-2"></i> Nama Lengkap & Jenis Kelamin</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i> Email Aktif & Nomor WhatsApp</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i> Asal Instansi & Tanggal Lahir</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i> Alamat di Yogyakarta</li>
                    </ul>
                    <p class="text-xs text-red-500 font-medium italic">*Pastikan email benar karena akan digunakan untuk akses Dashboard.</p>
                </div>
                <div class="sm:w-1/2 bg-slate-50 p-6 flex items-center justify-center border-t sm:border-t-0 sm:border-l border-slate-100">
                    <img src="{{ asset('images/tutorial-step1.png') }}" class="max-w-xs w-full h-auto rounded-xl shadow-md border border-slate-200 transform transition duration-300 group-hover:scale-105" alt="Step 1: Data Diri">
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden flex flex-col sm:flex-row group" data-aos="fade-up">
                <div class="sm:w-1/2 p-6 sm:p-8 flex flex-col justify-center order-1 sm:order-2">
                    <div class="inline-flex max-w-max items-center justify-center px-4 py-1.5 rounded-full bg-red-100 text-red-600 font-bold text-xs mb-4">
                        TAHAP 2
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Unggah Dokumen Penting</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Setelah menekan tombol "Selanjutnya", Anda akan diarahkan ke tahap pengumpulan dokumen pendukung. Anda wajib menyiapkan dan mengunggah:
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2 mb-4">
                        <li><i class="fas fa-file-pdf text-red-500 w-4 mr-2"></i> <strong>CV</strong> (Wajib, PDF maks 10MB)</li>
                        <li><i class="fab fa-instagram text-pink-500 w-4 mr-2"></i> <strong>Bukti Follow IG</strong> @sr_serdadukumbang</li>
                        <li><i class="fab fa-tiktok text-slate-800 w-4 mr-2"></i> <strong>Bukti Follow TikTok</strong> @sr_serdadukumbang</li>
                        <li><i class="fas fa-palette text-blue-500 w-4 mr-2"></i> <strong>Portofolio Desain</strong> (Khusus Media Branding)</li>
                    </ul>
                </div>
                <div class="sm:w-1/2 bg-slate-50 p-6 flex items-center justify-center border-t sm:border-t-0 sm:border-r border-slate-100 order-2 sm:order-1">
                    <img src="{{ asset('images/tutorial-step2.png') }}" class="max-w-xs w-full h-auto rounded-xl shadow-md border border-slate-200 transform transition duration-300 group-hover:scale-105" alt="Step 2: Upload Dokumen">
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden flex flex-col sm:flex-row group" data-aos="fade-up">
                <div class="sm:w-1/2 p-6 sm:p-8 flex flex-col justify-center">
                    <div class="inline-flex max-w-max items-center justify-center px-4 py-1.5 rounded-full bg-red-100 text-red-600 font-bold text-xs mb-4">
                        TAHAP 3
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tentukan Pilihan Divisi</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Tahap terakhir adalah memilih tempat Anda berkarya. Pada website ini, Anda dapat memilih hingga dua posisi:
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2 mb-4">
                        <li><i class="fas fa-lightbulb text-yellow-500 w-4 mr-2"></i> <strong>Motivasi</strong> & Sumber Info</li>
                        <li><i class="fas fa-star text-yellow-500 w-4 mr-2"></i> <strong>Pilihan Divisi 1 (Utama)</strong> & Alasan</li>
                        <li><i class="fas fa-star-half-alt text-yellow-500 w-4 mr-2"></i> <strong>Pilihan Divisi 2 (Cadangan)</strong> & Alasan</li>
                        <li><i class="fas fa-random text-blue-500 w-4 mr-2"></i> Kesediaan di Divisi Lain</li>
                    </ul>
                    <p class="text-xs text-slate-500 font-medium italic">Pastikan seluruh data sudah benar sebelum menekan tombol "Kirim Pendaftaran".</p>
                </div>
                <div class="sm:w-1/2 bg-slate-50 p-6 flex items-center justify-center border-t sm:border-t-0 sm:border-l border-slate-100">
                    <img src="{{ asset('images/tutorial-step3.png') }}" class="max-w-xs w-full h-auto rounded-xl shadow-md border border-slate-200 transform transition duration-300 group-hover:scale-105" alt="Step 3: Pilihan Divisi">
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="bg-emerald-50 rounded-2xl border border-emerald-100 overflow-hidden flex flex-col sm:flex-row group" data-aos="fade-up">
                <div class="sm:w-1/2 p-6 sm:p-8 flex flex-col justify-center order-1 sm:order-2">
                    <div class="inline-flex max-w-max items-center justify-center px-4 py-1.5 rounded-full bg-emerald-200 text-emerald-700 font-bold text-xs mb-4">
                        SELESAI
                    </div>
                    <h3 class="text-xl font-bold text-emerald-900 mb-3">Pantau Dashboard Akun Anda</h3>
                    <p class="text-sm text-emerald-700 leading-relaxed mb-4">
                        Setelah Form berhasil dikirim, Anda akan langsung mendapatkan akun! Proses selanjutnya:
                    </p>
                    <ul class="text-sm text-emerald-600 space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-sign-in-alt mt-1 mr-2"></i>
                            <span>Menu <a href="{{ route('login') }}" class="font-bold hover:underline">Login</a> dengan email dan password yang Anda buat.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock mt-1 mr-2"></i>
                            <span>Cek menu "Status Pendaftaran" secara berkala untuk pengumuman.</span>
                        </li>
                    </ul>
                </div>
                <div class="sm:w-1/2 bg-white p-6 flex items-center justify-center border-t sm:border-t-0 sm:border-r border-emerald-100 order-2 sm:order-1">
                    <img src="{{ asset('images/tutorial-step4.png') }}" class="max-w-xs w-full h-auto rounded-xl shadow-sm border border-slate-100 transform transition duration-300 group-hover:scale-105" alt="Step 4: Status Dashboard">
                </div>
            </div>

        </div> <!-- End Stacked Layout -->

        <div class="mt-16 text-center" data-aos="fade-up">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Sudah Paham Tahapannya?</h3>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('pendaftaran') }}" class="inline-flex justify-center items-center px-6 py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 shadow-md transition-all">
                    Mulai Daftar Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white text-slate-700 border border-slate-300 rounded-lg font-bold hover:bg-slate-50 transition-all">
                    Login ke Dashboard <i class="fas fa-user-circle ml-2"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
