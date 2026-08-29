@extends('admin.layout')

@section('title', 'Dashboard Admin | Masjid Jami Cicangkudu')

@section('content')
<!-- Header Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Dashboard Admin</h2>
            <p class="text-muted mb-0">Assalamu'alaikum, Selamat datang di Panel Pengelola Masjid.</p>
        </div>
        <span class="badge bg-success bg-opacity-15 text-success px-3 py-2 fw-semibold">Admin Panel</span>
    </div>
</div>

<!-- Kartu Ringkasan Statistik -->
<div class="row g-3 mb-4">
    <!-- Kotak Kas / Saldo -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 1rem;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-success bg-success bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-wallet fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">Total Saldo Kas</span>
                    <h4 class="fw-bold mb-0 text-dark">Rp 85.450.000</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Kotak Total Kegiatan -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 1rem;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-primary bg-primary bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-calendar-days fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">Total Kegiatan</span>
                    <h4 class="fw-bold mb-0 text-dark">12 Kegiatan</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Kotak Total Pengguna / Warga -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 1rem;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-warning bg-warning bg-opacity-10" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-users fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">Total Pengguna</span>
                    <h4 class="fw-bold mb-0 text-dark">1.250 Warga</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Informasi Tambahan / Pintasan Cepat -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3" style="color: #111d13;">Pintasan Pengelolaan Admin</h5>
        <div class="d-flex flex-wrap gap-2">
            <a href="#" class="btn btn-outline-success px-3 py-2 fw-semibold">
                <i class="fa-solid fa-calendar-plus me-1"></i> Kelola Jadwal
            </a>
            <a href="#" class="btn btn-outline-success px-3 py-2 fw-semibold">
                <i class="fa-solid fa-hand-holding-dollar me-1"></i> Verifikasi Donasi
            </a>
            <a href="#" class="btn btn-outline-success px-3 py-2 fw-semibold">
                <i class="fa-solid fa-file-invoice-dollar me-1"></i> Laporan Keuangan
            </a>
            <a href="{{ route('admin.import-warga') }}" class="btn btn-outline-success px-3 py-2 fw-semibold">
                <i class="fa-solid fa-user-plus me-1"></i> Import Warga
            </a>
        </div>
    </div>
</div>
@endsection