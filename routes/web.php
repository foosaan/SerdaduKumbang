<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAkunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminKontakController;
use App\Http\Controllers\AdminInformasiController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AdminKegiatanController;
use Illuminate\Support\Facades\Route;

// ===== HALAMAN UMUM =====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/informasi', [PageController::class, 'informasi'])->name('informasi');
Route::get('/informasi/{id}', [PageController::class, 'showInformasi'])->name('informasi.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');

// ===== FORM PENDAFTARAN =====
Route::get('/panduan-pendaftaran', [PageController::class, 'panduan'])->name('panduan');
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])
    // ->middleware('form.open')
    ->middleware('check.form.status')
    ->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// ===== AUTENTIKASI MANUAL =====
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== ADMIN LOGIN TERPISAH =====
Route::get('/admin/login', [AuthController::class, 'adminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');


Route::get('/register-success', function () {
    if (!session('email')) {
        return redirect()->route('home');
    }
    // Keep flash data alive for Vite HMR reloads
    session()->reflash();
    return view('auth.register_success', [
        'regName' => session('name'),
        'regEmail' => session('email'),
        'regPassword' => session('password'),
    ]);
})->name('register.success');


// ===== PROTEKSI AKSES (AUTH WAJIB) =====
Route::middleware('auth')->group(function () {
    
    // Dashboard umum (otomatis diarahkan berdasarkan role di controller)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===== DASHBOARD USER =====
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

    // ===== DASHBOARD ADMIN =====
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/pendaftar/{id}', [AdminController::class, 'show'])->name('admin.detail');
        Route::post('/admin/pendaftar/{id}/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
        Route::post('/admin/pendaftar/bulk-verifikasi', [AdminController::class, 'bulkVerifikasi'])->name('admin.bulkVerifikasi');
        Route::delete('/admin/pendaftar/hapus-semua', [AdminController::class, 'destroyAll'])->name('admin.destroyAll');
        Route::delete('/admin/pendaftar/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/admin/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
        Route::get('/admin/export/pdf', [AdminController::class, 'exportPDF'])->name('admin.export.pdf');
        Route::get('/admin/export/zip', [AdminController::class, 'exportZip'])->name('admin.export.zip');
        Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
        Route::post('/admin/notifikasi', [AdminController::class, 'kirimNotifikasi'])->name('admin.kirimNotifikasi');
        Route::get('/admin/status-form', [AdminController::class, 'statusForm'])->name('admin.statusForm');
        Route::post('/admin/status-form', [AdminController::class, 'updateStatusForm'])->name('admin.updateStatusForm');
        Route::get('/admin/informasi', [AdminInformasiController::class, 'index'])->name('admin.informasi.index');
        Route::get('/admin/informasi/create', [AdminInformasiController::class, 'create'])->name('admin.informasi.create');
        Route::post('/admin/informasi', [AdminInformasiController::class, 'store'])->name('admin.informasi.store');
        Route::get('/admin/informasi/{id}/edit', [AdminInformasiController::class, 'edit'])->name('admin.informasi.edit');
        Route::put('/admin/informasi/{id}', [AdminInformasiController::class, 'update'])->name('admin.informasi.update');
        Route::delete('/admin/informasi/{id}', [AdminInformasiController::class, 'destroy'])->name('admin.informasi.destroy');
        Route::get('/admin/kontak', [AdminKontakController::class, 'edit'])->name('admin.kontak');
        Route::put('/admin/kontak', [AdminKontakController::class, 'update'])->name('admin.kontak.update');
        Route::get('/admin/akun', [AdminAkunController::class, 'index'])->name('admin.akun.index');
        Route::get('/admin/akun/create', [AdminAkunController::class, 'create'])->name('admin.akun.create');
        Route::post('/admin/akun', [AdminAkunController::class, 'store'])->name('admin.akun.store');
        Route::get('/admin/akun/{id}/edit', [AdminAkunController::class, 'edit'])->name('admin.akun.edit');
        Route::put('/admin/akun/{id}', [AdminAkunController::class, 'update'])->name('admin.akun.update');
        Route::delete('/admin/akun/{id}', [AdminAkunController::class, 'destroy'])->name('admin.akun.destroy');
        Route::get('/admin/akun/{id}/reset-password', [AdminAkunController::class, 'resetPasswordForm'])->name('admin.akun.reset');
        Route::post('/admin/akun/{id}/reset-password', [AdminAkunController::class, 'resetPasswordUpdate'])->name('admin.akun.reset.update');
        Route::get('/admin/kegiatan', [AdminKegiatanController::class, 'index'])->name('admin.kegiatan.index');
        Route::get('/admin/kegiatan/create', [AdminKegiatanController::class, 'create'])->name('admin.kegiatan.create');
        Route::post('/admin/kegiatan', [AdminKegiatanController::class, 'store'])->name('admin.kegiatan.store');
        Route::get('/admin/kegiatan/{id}/edit', [AdminKegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
        Route::put('/admin/kegiatan/{id}', [AdminKegiatanController::class, 'update'])->name('admin.kegiatan.update');
        Route::delete('/admin/kegiatan/{id}', [AdminKegiatanController::class, 'destroy'])->name('admin.kegiatan.destroy');

        Route::get('/admin/partner', [\App\Http\Controllers\AdminPartnerController::class, 'index'])->name('admin.partner.index');
        Route::get('/admin/partner/create', [\App\Http\Controllers\AdminPartnerController::class, 'create'])->name('admin.partner.create');
        Route::post('/admin/partner', [\App\Http\Controllers\AdminPartnerController::class, 'store'])->name('admin.partner.store');
        Route::get('/admin/partner/{id}/edit', [\App\Http\Controllers\AdminPartnerController::class, 'edit'])->name('admin.partner.edit');
        Route::put('/admin/partner/{id}', [\App\Http\Controllers\AdminPartnerController::class, 'update'])->name('admin.partner.update');
        Route::delete('/admin/partner/{id}', [\App\Http\Controllers\AdminPartnerController::class, 'destroy'])->name('admin.partner.destroy');

        Route::get('/admin/pengurus', [\App\Http\Controllers\AdminPengurusController::class, 'index'])->name('admin.pengurus.index');
        Route::get('/admin/pengurus/create', [\App\Http\Controllers\AdminPengurusController::class, 'create'])->name('admin.pengurus.create');
        Route::post('/admin/pengurus', [\App\Http\Controllers\AdminPengurusController::class, 'store'])->name('admin.pengurus.store');
        Route::get('/admin/pengurus/{id}/edit', [\App\Http\Controllers\AdminPengurusController::class, 'edit'])->name('admin.pengurus.edit');
        Route::put('/admin/pengurus/{id}', [\App\Http\Controllers\AdminPengurusController::class, 'update'])->name('admin.pengurus.update');
        Route::delete('/admin/pengurus/{id}', [\App\Http\Controllers\AdminPengurusController::class, 'destroy'])->name('admin.pengurus.destroy');
    });

    // ===== PROFILE =====
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== FILE AUTH DEFAULT (breeze/jetstream) =====
require __DIR__.'/auth.php';

