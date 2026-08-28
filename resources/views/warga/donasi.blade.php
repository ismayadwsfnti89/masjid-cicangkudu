@extends('warga.layout')
@section('title', 'Donasi | Masjid Jami Cicangkudu')
@section('header', 'Donasi')

@section('content')
<div class="page-header mb-4">
    <a class="back-link text-decoration-none mb-2 d-inline-block" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <h2>Donasi</h2>
    <p class="text-muted">Dukung kegiatan dan program Masjid Jami Cicangkudu.</p>
</div>

<!-- SECTION: PROGRAM DONASI -->
<div class="mb-5">
    <div class="section-heading mb-3">
        <h2>Program Donasi</h2>
        <span class="text-muted small">Pilih program donasi yang ingin kamu dukung</span>
    </div>
    
    <div class="row g-4">
        <!-- PROGRAM 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Pembangunan</span>
                    <h5 class="fw-bold mb-2">Renovasi Masjid</h5>
                    <p class="text-muted small">
                        Donasi untuk membantu perawatan dan renovasi fasilitas Masjid Jami Cicangkudu.
                    </p>
                </div>
                <div class="donation-progress mt-3">
                    <div class="progress-info d-flex justify-content-between mb-1 small">
                        <span>Terkumpul</span>
                        <strong class="text-dark">Rp 7.500.000</strong>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 75%;"></div>
                    </div>
                    <small class="text-muted">Target Rp 10.000.000</small>
                </div>
            </div>
        </div>

        <!-- PROGRAM 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Sosial</span>
                    <h5 class="fw-bold mb-2">Santunan Anak Yatim</h5>
                    <p class="text-muted small">
                        Bantuan untuk kegiatan santunan dan kebutuhan anak yatim di sekitar masjid.
                    </p>
                </div>
                <div class="donation-progress mt-3">
                    <div class="progress-info d-flex justify-content-between mb-1 small">
                        <span>Terkumpul</span>
                        <strong class="text-dark">Rp 3.000.000</strong>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 60%;"></div>
                    </div>
                    <small class="text-muted">Target Rp 5.000.000</small>
                </div>
            </div>
        </div>

        <!-- PROGRAM 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Pendidikan</span>
                    <h5 class="fw-bold mb-2">Wakaf Al-Qur'an</h5>
                    <p class="text-muted small">
                        Program pengadaan Al-Qur'an untuk jamaah dan kegiatan pendidikan masjid.
                    </p>
                </div>
                <div class="donation-progress mt-3">
                    <div class="progress-info d-flex justify-content-between mb-1 small">
                        <span>Terkumpul</span>
                        <strong class="text-dark">Rp 1.500.000</strong>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 50%;"></div>
                    </div>
                    <small class="text-muted">Target Rp 3.000.000</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION: METODE PEMBAYARAN -->
<div class="mb-5">
    <div class="section-heading mb-3">
        <h2>Cara Berdonasi</h2>
        <span class="text-muted small">Pilih salah satu metode pembayaran yang tersedia</span>
    </div>

    <div class="row g-4">
        <!-- TRANSFER BANK -->
        <div class="col-md-6">
            <div class="content-card h-100">
                <div class="d-flex align-items-start mb-3">
                    <div class="payment-icon text-success fs-3 me-3">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Transfer Bank</h5>
                        <p class="text-muted small mb-0">Bank Contoh</p>
                    </div>
                </div>
                <div class="account-number bg-light p-3 rounded text-center fw-bold fs-5 mb-2 text-dark font-monospace">
                    1234 5678 9012
                </div>
                <p class="text-muted small mb-2 text-center">a.n. Masjid Jami Cicangkudu</p>
                <small class="text-muted d-block text-center fst-italic">
                    Nomor rekening di atas hanya contoh untuk prototype.
                </small>
            </div>
        </div>

        <!-- QRIS -->
        <div class="col-md-6">
            <div class="content-card h-100 text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="payment-icon text-success fs-3 me-2">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <h5 class="fw-bold mb-0">QRIS</h5>
                </div>
                <p class="text-muted small mb-3">
                    Scan QRIS Masjid Jami Cicangkudu untuk melakukan donasi.
                </p>
                <div class="qris-placeholder border border-2 border-dashed p-4 rounded bg-light mb-3 d-inline-block">
                    <i class="fa-solid fa-qrcode fs-1 text-muted"></i>
                    <span class="d-block small text-muted mt-1">QRIS Placeholder</span>
                </div>
                <small class="text-muted d-block fst-italic">
                    QRIS asli akan ditambahkan setelah sistem pembayaran ditentukan.
                </small>
            </div>
        </div>
    </div>
</div>

<!-- SECTION: KONFIRMASI -->
<div>
    <div class="content-card bg-light border-0">
        <h4 class="section-title fw-bold fs-5 mb-2">Sudah melakukan donasi?</h4>
        <p class="text-muted mb-0 small">
            Silakan simpan bukti pembayaran. Pada tahap berikutnya dapat dibuat fitur konfirmasi donasi untuk warga.
        </p>
    </div>
</div>
@endsection