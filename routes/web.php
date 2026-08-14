<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [Authcontroller::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');