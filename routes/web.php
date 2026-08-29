<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaProfileController;
use App\Http\Controllers\WargaImportController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Tempat pendaftaran seluruh rute web pada aplikasi Digital Mosque System.
|
*/

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Routes untuk Warga (Authenticated User)
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'warga.dashboard')->name('dashboard');
    Route::view('/jadwal', 'warga.jadwal')->name('jadwal');
    Route::view('/kegiatan', 'warga.kegiatan')->name('kegiatan');
    Route::view('/donasi', 'warga.donasi')->name('donasi');
    Route::view('/laporan', 'warga.laporan')->name('laporan');
    Route::view('/informasi-masjid', 'warga.informasi')->name('informasi');

    // Profil Warga
    Route::get('/profil-warga', [WargaProfileController::class, 'index'])->name('profil');
    Route::put('/profil-warga', [WargaProfileController::class, 'update'])->name('profil.update');
});

// Routes Khusus Admin (Panel Pengelola)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::get('/jadwal', [AdminJadwalController::class, 'index'])->name('jadwal');
    
    // Manajemen Warga & Import
// Ubah baris ini di dalam group admin
    Route::get('/admins', [AdminUserController::class, 'adminIndex'])->name('admins');    
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::get('/import-warga', [WargaImportController::class, 'index'])->name('import-warga');
    Route::post('/import-warga', [WargaImportController::class, 'import'])->name('import-warga.store');
});