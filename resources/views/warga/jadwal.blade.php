@extends('warga.layout')
@section('title', 'Jadwal Salat | Masjid Jami Cicangkudu')
@section('header', 'Jadwal Salat')
@section('content')
<div class="page-header">
    <a class="back-link" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>
    <h2>Jadwal Salat</h2>
    <p>
        Jadwal salat Masjid Jami Cicangkudu.
    </p>
</div>
<div class="date-card mb-4">
    <i class="fa-solid fa-calendar-day"></i>
    <div>
        <span class="date-label">
            Hari ini
        </span>
        <h5 id="tanggalHariIni">
            Memuat tanggal...
        </h5>
    </div>
</div>
<div class="content-card">
    <h4 class="section-title">
        Jadwal Salat Hari Ini
    </h4>
    <p class="section-description">
        Jadwal salat diperoleh secara otomatis
        berdasarkan lokasi Masjid Jami Cicangkudu.
    </p>
    <div class="row g-4">
        <!-- =========================
                         SUBUH
                    ========================= -->
        <div class="col-md-6 col-lg-4">
            <div class="prayer-card">
                <div class="prayer-icon">
                    <i class="fa-solid fa-cloud-sun"></i>
                </div>
                <div class="prayer-info">
                    <span>
                        Subuh
                    </span>
                    <strong id="subuh">
                        --:--
                    </strong>
                </div>
            </div>
        </div>
        <!-- =========================
                         DZUHUR
                    ========================= -->
        <div class="col-md-6 col-lg-4">
            <div class="prayer-card">
                <div class="prayer-icon">
                    <i class="fa-solid fa-sun"></i>
                </div>
                <div class="prayer-info">
                    <span>
                        Dzuhur
                    </span>
                    <strong id="dzuhur">
                        --:--
                    </strong>
                </div>
            </div>
        </div>
        <!-- =========================
                         ASHAR
                    ========================= -->
        <div class="col-md-6 col-lg-4">
            <div class="prayer-card">
                <div class="prayer-icon">
                    <i class="fa-solid fa-cloud-sun"></i>
                </div>
                <div class="prayer-info">
                    <span>
                        Ashar
                    </span>
                    <strong id="ashar">
                        --:--
                    </strong>
                </div>
            </div>
        </div>
        <!-- =========================
                         MAGHRIB
                    ========================= -->
        <div class="col-md-6 col-lg-4">
            <div class="prayer-card">
                <div class="prayer-icon">
                    <i class="fa-solid fa-cloud-sun"></i>
                </div>
                <div class="prayer-info">
                    <span>
                        Maghrib
                    </span>
                    <strong id="maghrib">
                        --:--
                    </strong>
                </div>
            </div>
        </div>
        <!-- =========================
                         ISYA
                    ========================= -->
        <div class="col-md-6 col-lg-4">
            <div class="prayer-card">
                <div class="prayer-icon">
                    <i class="fa-solid fa-moon"></i>
                </div>
                <div class="prayer-info">
                    <span>
                        Isya
                    </span>
                    <strong id="isya">
                        --:--
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
INFORMASI
<div class="prayer-note mt-4">
    <i class="fa-solid fa-circle-info"></i>
    <div>
        <strong>
            Informasi
        </strong>
        <p>
            Jadwal salat diperoleh secara otomatis
            berdasarkan lokasi Masjid Jami Cicangkudu.
        </p>
    </div>
</div>
@endsection