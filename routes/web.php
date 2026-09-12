<?php

use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminFamilyController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminKasKkController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MasjidInformationController;
use App\Http\Controllers\MasjidProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentSettingController;
use App\Http\Controllers\WargaDashboardController;
use App\Http\Controllers\WargaImportController;
use App\Http\Controllers\WargaKasController;
use App\Http\Controllers\WargaProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Tempat pendaftaran seluruh rute web pada aplikasi Digital Mosque System.
|
*/

// Authentication Routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::post('/donasi/kirim', [DonationController::class, 'storePublic'])->name('donasi.public.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Routes untuk Warga (Authenticated User)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');
    Route::view('/jadwal', 'warga.jadwal')->name('jadwal');
    Route::get('/kegiatan', [AdminContentController::class, 'wargaKegiatan'])->name('kegiatan');
    Route::get('/donasi', [DonationController::class, 'index'])->name('donasi');
    Route::post('/donasi', [DonationController::class, 'store'])->name('donasi.store');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/kas-saya', [WargaKasController::class, 'index'])->name('kas.saya');
    Route::post('/kas-saya/bayar', [WargaKasController::class, 'pay'])->name('kas.saya.bayar');
    Route::get('/informasi-masjid', [MasjidInformationController::class, 'index'])->name('informasi');

    // Profil Warga
    Route::get('/profil-warga', [WargaProfileController::class, 'index'])->name('profil');
    Route::put('/profil-warga', [WargaProfileController::class, 'update'])->name('profil.update');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications');
});

// Routes Khusus Admin (Panel Pengelola)
Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/verifikasi-pembayaran', [AdminDashboardController::class, 'verifications'])->name('verifications');
    Route::get('/notifikasi', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::get('/jadwal', [AdminJadwalController::class, 'index'])->name('jadwal');

    // Manajemen warga dan impor data.
    Route::get('/admins', [AdminUserController::class, 'adminIndex'])->name('admins');
    Route::get('/admins/create', [AdminUserController::class, 'createAdmin'])->name('admins.create');
    Route::post('/admins', [AdminUserController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/users', [AdminUserController::class, 'bulkDestroy'])->name('users.bulk-destroy');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/import-warga', [WargaImportController::class, 'index'])->name('import-warga');
    Route::post('/import-warga', [WargaImportController::class, 'import'])->name('import-warga.store');
    Route::post('/donasi/pengaturan', [PaymentSettingController::class, 'update'])->name('payment-settings.update');
    Route::put('/profil-masjid', [MasjidProfileController::class, 'update'])->name('masjid-profile.update');
    Route::put('/donasi/{donation}/verifikasi', [AdminDonationController::class, 'verify'])->name('donations.verify');
    Route::put('/donasi/{donation}/tolak', [AdminDonationController::class, 'reject'])->name('donations.reject');
    Route::get('families/import', [AdminFamilyController::class, 'importForm'])->name('families.import');
    Route::post('families/import', [AdminFamilyController::class, 'import'])->name('families.import.store');
    Route::resource('families', AdminFamilyController::class)->except('show');
    Route::resource('kas-kk', AdminKasKkController::class)->parameters(['kas-kk' => 'kasKk']);
    Route::put('kas-kk/{kasKk}/verifikasi', [AdminKasKkController::class, 'verify'])->name('kas-kk.verify');
    Route::put('kas-kk/{kasKk}/tolak', [AdminKasKkController::class, 'reject'])->name('kas-kk.reject');

    Route::prefix('{section}')
        ->whereIn('section', ['kegiatan', 'donasi', 'laporan-keuangan', 'informasi-masjid'])
        ->name('contents.')
        ->controller(AdminContentController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{content}/edit', 'edit')->name('edit');
            Route::put('/{content}', 'update')->name('update');
            Route::delete('/{content}', 'destroy')->name('destroy');
            Route::delete('/', 'bulkDestroy')->name('bulk-destroy');
        });
});
