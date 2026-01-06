<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminKontakController;
use App\Http\Controllers\AdminInformasiController;
use Illuminate\Support\Facades\Route;

// ===== HALAMAN UMUM =====
Route::get('/', [PendaftaranController::class, 'home'])->name('home');
Route::get('/informasi', [PendaftaranController::class, 'informasi'])->name('informasi');
Route::get('/informasi/{id}', [PendaftaranController::class, 'showInformasi'])->name('informasi.show');
Route::get('/contact', [PendaftaranController::class, 'contact'])->name('contact');

// ===== FORM PENDAFTARAN =====
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])
    // ->middleware('form.open')
    ->middleware('check.form.status')
    ->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// ===== AUTENTIKASI MANUAL =====
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register-success', function () {
    return view('auth.register_success');
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
        Route::delete('/admin/pendaftar/hapus-semua', [AdminController::class, 'destroyAll'])->name('admin.destroyAll');
        Route::delete('/admin/pendaftar/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/admin/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
        Route::get('/admin/export/pdf', [AdminController::class, 'exportPDF'])->name('admin.export.pdf');
        Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi'])->name('admin.notifikasi');
        Route::post('/admin/notifikasi', [AdminController::class, 'kirimNotifikasi'])->name('admin.kirimNotifikasi');
        Route::get('/admin/status-form', [AdminController::class, 'statusForm'])->name('admin.statusForm');
        Route::post('/admin/status-form', [AdminController::class, 'updateStatusForm'])->name('admin.updateStatusForm');
        Route::get('/admin/informasi', [\App\Http\Controllers\AdminInformasiController::class, 'index'])->name('admin.informasi.index');
        Route::get('/admin/informasi/create', [\App\Http\Controllers\AdminInformasiController::class, 'create'])->name('admin.informasi.create');
        Route::post('/admin/informasi', [\App\Http\Controllers\AdminInformasiController::class, 'store'])->name('admin.informasi.store');
        Route::get('/admin/informasi/{id}/edit', [\App\Http\Controllers\AdminInformasiController::class, 'edit'])->name('admin.informasi.edit');
        Route::put('/admin/informasi/{id}', [\App\Http\Controllers\AdminInformasiController::class, 'update'])->name('admin.informasi.update');
        Route::delete('/informasi/{id}', [\App\Http\Controllers\AdminInformasiController::class, 'destroy'])->name('admin.informasi.destroy');
        Route::get('/admin/kontak', [AdminKontakController::class, 'edit'])->name('admin.kontak');
        Route::put('/admin/kontak', [AdminKontakController::class, 'update'])->name('admin.kontak.update');
        Route::get('/admin/akun', [AdminController::class, 'adminIndex'])->name('admin.akun.index');
        Route::get('/admin/akun/create', [AdminController::class, 'adminCreate'])->name('admin.akun.create');
        Route::post('/admin/akun', [AdminController::class, 'adminStore'])->name('admin.akun.store');
        Route::get('/admin/akun/{id}/edit', [AdminController::class, 'adminEdit'])->name('admin.akun.edit');
        Route::put('/admin/akun/{id}', [AdminController::class, 'adminUpdate'])->name('admin.akun.update');
        Route::delete('/admin/akun/{id}', [AdminController::class, 'adminDestroy'])->name('admin.akun.destroy');
        Route::get('/akun/{id}/reset-password', [AdminController::class, 'resetPasswordForm'])->name('admin.akun.reset');
        Route::post('/akun/{id}/reset-password', [AdminController::class, 'resetPasswordUpdate'])->name('admin.akun.reset.update');
    });

    // ===== PROFILE =====
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== FILE AUTH DEFAULT (breeze/jetstream) =====
require __DIR__.'/auth.php';

