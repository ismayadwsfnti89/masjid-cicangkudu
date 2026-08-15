<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaProfileController;
use App\Http\Controllers\WargaImportController;


Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [Authcontroller::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'warga.dashboard')->name('dashboard');
    Route::view('/jadwal', 'warga.jadwal')->name('jadwal');
    Route::view('/kegiatan', 'warga.kegiatan')->name('kegiatan');
    Route::view('/donasi', 'warga.donasi')->name('donasi');
    Route::view('/laporan', 'warga.laporan')->name('laporan');
    Route::view('/informasi-masjid', 'warga.informasi')->name('informasi');
});

Route::get('/profil-warga', [WargaProfileController::class, 'index'])->name('profil');
Route::put('/profil-warga', [WargaProfileController::class, 'update'])->name('profil.update');
Route::get('/admin/import-warga', [WargaImportController::class, 'index'])->name('admin.import-warga');
Route::post('/admin/import-warga', [WargaImportController::class, 'import'])->name('admin.import-warga.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');