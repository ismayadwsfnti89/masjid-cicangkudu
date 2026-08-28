<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaProfileController;
use App\Http\Controllers\WargaImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat untuk mendaftarkan web routes pada aplikasi Anda.
|
*/

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk Pengguna yang Sudah Login (Warga / Umum)
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'warga.dashboard')->name('dashboard');
    Route::view('/jadwal', 'warga.jadwal')->name('jadwal');
    Route::view('/kegiatan', 'warga.kegiatan')->name('kegiatan');
    Route::view('/donasi', 'warga.donasi')->name('donasi');
    Route::view('/laporan', 'warga.laporan')->name('laporan');
    Route::view('/informasi-masjid', 'warga.informasi')->name('informasi');

    // Tambahkan rute Profil di sini
    Route::get('/profil-warga', [WargaProfileController::class, 'index'])->name('profil');
    Route::put('/profil-warga', [WargaProfileController::class, 'update'])->name('profil.update');
});

// Routes Khusus Admin (Import Warga)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/import-warga', [WargaImportController::class, 'index'])->name('import-warga');
    Route::post('/import-warga', [WargaImportController::class, 'import'])->name('import-warga.store');
});