@extends('warga.layout')

@section('title', 'Laporan Keuangan | Masjid Jami Cicangkudu')

@section('content')
<!-- Tombol Kembali & Header Section -->
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Laporan Keuangan</h2>
            <p class="text-muted mb-0">Transparansi pemasukan dan pengeluaran Masjid Jami Cicangkudu.</p>
        </div>
        <span class="text-muted small d-none d-md-inline">Sistem Digital Masjid</span>
    </div>
</div>

<!-- Ringkasan Keuangan Cards -->
<div class="row g-4 mb-4">
    <!-- PEMASUKAN -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px; min-width: 52px; background-color: #e8f5e9; color: #0b5c3d;">
                    <i class="fa-solid fa-arrow-down fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small d-block mb-1">Total Pemasukan</span>
                    <h4 class="fw-bold mb-0" style="color: #0b5c3d;">Rp 12.000.000</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- PENGELUARAN -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px; min-width: 52px; background-color: #fbe9e7; color: #d32f2f;">
                    <i class="fa-solid fa-arrow-up fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small d-block mb-1">Total Pengeluaran</span>
                    <h4 class="fw-bold mb-0" style="color: #d32f2f;">Rp 4.500.000</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- SALDO -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px; min-width: 52px; background-color: #e3f2fd; color: #1976d2;">
                    <i class="fa-solid fa-wallet fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small d-block mb-1">Saldo</span>
                    <h4 class="fw-bold mb-0" style="color: #1976d2;">Rp 7.500.000</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter dan Tabel Laporan -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4 p-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h5 class="fw-bold mb-1" style="color: #111d13;">Riwayat Transaksi</h5>
                <p class="text-muted mb-0 small">Daftar pemasukan dan pengeluaran Masjid Jami Cicangkudu.</p>
            </div>
            <div style="width: 200px;">
                <select class="form-select form-select-sm border-light bg-light py-2">
                    <option selected>Agustus 2026</option>
                    <option>Juli 2026</option>
                    <option>Juni 2026</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light text-uppercase fs-7 text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <tr>
                        <th class="py-3 ps-3 rounded-start">Tanggal</th>
                        <th class="py-3">Keterangan</th>
                        <th class="py-3">Jenis</th>
                        <th class="py-3 pe-3 text-end rounded-end">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TRANSAKSI 1 -->
                    <tr>
                        <td class="ps-3 text-muted small">02 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Donasi Jamaah</td>
                        <td>
                            <span class="badge bg-success bg-opacity-15 text-success px-2 py-1 small fw-semibold">Pemasukan</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-success">+ Rp 2.500.000</td>
                    </tr>
                    <!-- TRANSAKSI 2 -->
                    <tr>
                        <td class="ps-3 text-muted small">05 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Pembelian Perlengkapan Masjid</td>
                        <td>
                            <span class="badge bg-danger bg-opacity-15 text-danger px-2 py-1 small fw-semibold">Pengeluaran</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-danger">- Rp 1.000.000</td>
                    </tr>
                    <!-- TRANSAKSI 3 -->
                    <tr>
                        <td class="ps-3 text-muted small">08 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Donasi Renovasi Masjid</td>
                        <td>
                            <span class="badge bg-success bg-opacity-15 text-success px-2 py-1 small fw-semibold">Pemasukan</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-success">+ Rp 3.000.000</td>
                    </tr>
                    <!-- TRANSAKSI 4 -->
                    <tr>
                        <td class="ps-3 text-muted small">10 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Biaya Listrik dan Air</td>
                        <td>
                            <span class="badge bg-danger bg-opacity-15 text-danger px-2 py-1 small fw-semibold">Pengeluaran</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-danger">- Rp 1.500.000</td>
                    </tr>
                    <!-- TRANSAKSI 5 -->
                    <tr>
                        <td class="ps-3 text-muted small">12 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Donasi Masyarakat</td>
                        <td>
                            <span class="badge bg-success bg-opacity-15 text-success px-2 py-1 small fw-semibold">Pemasukan</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-success">+ Rp 1.500.000</td>
                    </tr>
                    <!-- TRANSAKSI 6 -->
                    <tr>
                        <td class="ps-3 text-muted small">12 Agustus 2026</td>
                        <td class="fw-semibold text-dark">Perawatan Fasilitas Masjid</td>
                        <td>
                            <span class="badge bg-danger bg-opacity-15 text-danger px-2 py-1 small fw-semibold">Pengeluaran</span>
                        </td>
                        <td class="pe-3 text-end fw-bold text-danger">- Rp 2.000.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Transparansi Info Card -->
<div class="card border-0 shadow-sm" style="border-radius: 1rem; background-color: #e8f5e9;">
    <div class="card-body p-4 d-flex align-items-start">
        <div class="me-3 text-success fs-4 mt-1">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
            <strong class="fw-bold d-block mb-1" style="color: #0b5c3d;">Transparansi Keuangan</strong>
            <p class="text-muted mb-0 small">
                Laporan keuangan ditampilkan sebagai bentuk transparansi kepada warga dan jamaah Masjid Jami Cicangkudu. Data pada halaman ini masih berupa data prototype dan nantinya akan dikelola oleh admin.
            </p>
        </div>
    </div>
</div>
@endsection