@extends('warga.layout')
@section('title', 'Donasi | Masjid Jami Cicangkudu')
@section('header', 'Donasi')
@section('content')
<div class="page-header">
    <a class="back-link" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>
    <h2>Donasi</h2>
    <p>
        Dukung kegiatan dan program Masjid Jami Cicangkudu.
    </p>
</div>
PROGRAM DONASI
<div class="content-card">
    <h4 class="section-title">
        Program Donasi
    </h4>
    <p class="section-description">
        Pilih program donasi yang ingin kamu dukung.
    </p>
    <div class="row g-4">
        <!-- PROGRAM 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="donation-card">
                <div class="donation-icon">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div class="donation-content">
                    <span class="donation-category">
                        Pembangunan
                    </span>
                    <h5>
                        Renovasi Masjid
                    </h5>
                    <p>
                        Donasi untuk membantu perawatan
                        dan renovasi fasilitas
                        Masjid Jami Cicangkudu.
                    </p>
                    <div class="donation-progress">
                        <div class="progress-info">
                            <span>
                                Terkumpul
                            </span>
                            <strong>
                                Rp 7.500.000
                            </strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 75%;">
                            </div>
                        </div>
                        <small>
                            Target Rp 10.000.000
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <!-- PROGRAM 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="donation-card">
                <div class="donation-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div class="donation-content">
                    <span class="donation-category">
                        Sosial
                    </span>
                    <h5>
                        Santunan Anak Yatim
                    </h5>
                    <p>
                        Bantuan untuk kegiatan santunan
                        dan kebutuhan anak yatim
                        di sekitar masjid.
                    </p>
                    <div class="donation-progress">
                        <div class="progress-info">
                            <span>
                                Terkumpul
                            </span>
                            <strong>
                                Rp 3.000.000
                            </strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 60%;">
                            </div>
                        </div>
                        <small>
                            Target Rp 5.000.000
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <!-- PROGRAM 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="donation-card">
                <div class="donation-icon">
                    <i class="fa-solid fa-book-quran"></i>
                </div>
                <div class="donation-content">
                    <span class="donation-category">
                        Pendidikan
                    </span>
                    <h5>
                        Wakaf Al-Qur'an
                    </h5>
                    <p>
                        Program pengadaan Al-Qur'an
                        untuk jamaah dan kegiatan
                        pendidikan masjid.
                    </p>
                    <div class="donation-progress">
                        <div class="progress-info">
                            <span>
                                Terkumpul
                            </span>
                            <strong>
                                Rp 1.500.000
                            </strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 50%;">
                            </div>
                        </div>
                        <small>
                            Target Rp 3.000.000
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
METODE PEMBAYARAN
<div class="donation-method-section">
    <div class="content-card">
        <h4 class="section-title">
            Cara Berdonasi
        </h4>
        <p class="section-description">
            Pilih salah satu metode pembayaran yang tersedia.
        </p>
        <div class="row g-4">
            <!-- BANK -->
            <div class="col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div class="payment-content">
                        <h5>
                            Transfer Bank
                        </h5>
                        <p>
                            Bank Contoh
                        </p>
                        <div class="account-number">
                            1234 5678 9012
                        </div>
                        <p>
                            a.n. Masjid Jami Cicangkudu
                        </p>
                        <small>
                            Nomor rekening di atas hanya
                            contoh untuk prototype.
                        </small>
                    </div>
                </div>
            </div>
            <!-- QRIS -->
            <div class="col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <div class="payment-content">
                        <h5>
                            QRIS
                        </h5>
                        <p>
                            Scan QRIS Masjid Jami
                            Cicangkudu untuk melakukan donasi.
                        </p>
                        <div class="qris-placeholder">
                            <i class="fa-solid fa-qrcode"></i>
                            <span>
                                QRIS
                            </span>
                        </div>
                        <small>
                            QRIS asli akan ditambahkan
                            setelah sistem pembayaran ditentukan.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
KONFIRMASI
<div class="content-card">
    <h4 class="section-title">
        Sudah melakukan donasi?
    </h4>
    <p class="section-description">
        Silakan simpan bukti pembayaran.
        Pada tahap berikutnya dapat dibuat fitur
        konfirmasi donasi untuk warga.
    </p>
</div>
@endsection