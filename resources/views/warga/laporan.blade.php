@extends('warga.layout')
@section('title', 'Laporan Keuangan | Masjid Jami Cicangkudu')
@section('header', 'Laporan Keuangan')
@section('content')
<div class="page-header">
    <a class="back-link" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i>

        Kembali ke Dashboard

    </a>
    <h2>
        Laporan Keuangan
    </h2>
    <p>
        Transparansi pemasukan dan pengeluaran
        Masjid Jami Cicangkudu.
    </p>
</div>
<div class="row g-4 mb-4">
    <!-- PEMASUKAN -->
    <div class="col-md-6 col-lg-4">
        <div class="finance-card">
            <div class="finance-icon income">
                <i class="fa-solid fa-arrow-down"></i>
            </div>
            <div>
                <span>
                    Total Pemasukan
                </span>
                <h4>
                    Rp 12.000.000
                </h4>
            </div>
        </div>
    </div>
    <!-- PENGELUARAN -->
    <div class="col-md-6 col-lg-4">
        <div class="finance-card">
            <div class="finance-icon expense">
                <i class="fa-solid fa-arrow-up"></i>
            </div>
            <div>
                <span>
                    Total Pengeluaran
                </span>
                <h4>
                    Rp 4.500.000
                </h4>
            </div>
        </div>
    </div>
    <!-- SALDO -->
    <div class="col-md-6 col-lg-4">
        <div class="finance-card">
            <div class="finance-icon balance">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span>
                    Saldo
                </span>
                <h4>
                    Rp 7.500.000
                </h4>
            </div>
        </div>
    </div>
</div>
FILTER LAPORAN
<div class="report-filter">
    <div>
        <h5>
            Riwayat Transaksi
        </h5>
        <p>
            Daftar pemasukan dan pengeluaran
            Masjid Jami Cicangkudu.
        </p>
    </div>
    <select class="form-select">
        <option>
            Agustus 2026
        </option>
        <option>
            Juli 2026
        </option>
        <option>
            Juni 2026
        </option>
    </select>
</div>
TABEL LAPORAN
<div class="report-table">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>
                    </th>
                    <th>
                        Keterangan
                    </th>
                    <th>
                        Jenis
                    </th>
                    <th>
                        Nominal
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- TRANSAKSI 1 -->
                <tr>
                    <td>
                        02 Agustus 2026
                    </td>
                    <td>
                        Donasi Jamaah
                    </td>
                    <td>
                        <span class="transaction income-label">
                            Pemasukan
                        </span>
                    </td>
                    <td class="income-text">
                        + Rp 2.500.000
                    </td>
                </tr>
                <!-- TRANSAKSI 2 -->
                <tr>
                    <td>
                        05 Agustus 2026
                    </td>
                    <td>
                        Pembelian Perlengkapan Masjid
                    </td>
                    <td>
                        <span class="transaction expense-label">
                            Pengeluaran
                        </span>
                    </td>
                    <td class="expense-text">
                        - Rp 1.000.000
                    </td>
                </tr>
                <!-- TRANSAKSI 3 -->
                <tr>
                    <td>
                        08 Agustus 2026
                    </td>
                    <td>
                        Donasi Renovasi Masjid
                    </td>
                    <td>
                        <span class="transaction income-label">
                            Pemasukan
                        </span>
                    </td>
                    <td class="income-text">
                        + Rp 3.000.000
                    </td>
                </tr>
                <!-- TRANSAKSI 4 -->
                <tr>
                    <td>
                        10 Agustus 2026
                    </td>
                    <td>
                        Biaya Listrik dan Air
                    </td>
                    <td>
                        <span class="transaction expense-label">
                            Pengeluaran
                        </span>
                    </td>
                    <td class="expense-text">
                        - Rp 1.500.000
                    </td>
                </tr>
                <!-- TRANSAKSI 5 -->
                <tr>
                    <td>
                        12 Agustus 2026
                    </td>
                    <td>
                        Donasi Masyarakat
                    </td>
                    <td>
                        <span class="transaction income-label">
                            Pemasukan
                        </span>
                    </td>
                    <td class="income-text">
                        + Rp 1.500.000
                    </td>
                </tr>
                <!-- TRANSAKSI 6 -->
                <tr>
                    <td>
                        12 Agustus 2026
                    </td>
                    <td>
                        Perawatan Fasilitas Masjid
                    </td>
                    <td>
                        <span class="transaction expense-label">
                            Pengeluaran
                        </span>
                    </td>
                    <td class="expense-text">
                        - Rp 2.000.000
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
TRANSPARANSI
<div class="transparency-card">
    <div class="transparency-icon">
        <i class="fa-solid fa-shield-halved"></i>
    </div>
    <div>
        <h5>
            Transparansi Keuangan
        </h5>
        <p>
            Laporan keuangan ditampilkan sebagai
            bentuk transparansi kepada warga dan
            jamaah Masjid Jami Cicangkudu.
            Data pada halaman ini masih berupa
            data prototype dan nantinya akan
            dikelola oleh admin.
        </p>
    </div>
</div>
@endsection