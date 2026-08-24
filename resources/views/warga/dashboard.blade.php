@extends('warga.layout')
@section('title', 'Dashboard Warga | Masjid Jami Cicangkudu')
@section('header', 'Dashboard warga')
@section('content')
<div class="hero-grid">
    <section class="welcome-hero">
        <div class="hero-kicker">Sistem digital masjid</div>
        <h1>Assalamu'alaikum, {{ auth()->user()->name ?? 'Warga' }}.</h1>
        <p>Semua kabar, kegiatan, dan layanan Masjid Jami Cicangkudu ada di satu tempat.</p>
    </section>
    <section class="next-prayer"><span class="muted-label">Salat berikutnya</span><strong class="next-time">15:09</strong><strong class="next-name">Asar</strong><span class="next-meta">01 jam 42 menit lagi</span>
        <div class="prayer-progress"><i></i></div>
        <div class="progress-meta"><span>Dzuhur 12:02</span><span>Maghrib 17:58</span></div>
    </section>
</div>
<div class="section-heading">
    <h2>Menu cepat</h2><a href="{{ route('informasi') }}">Lihat semua</a>
</div>
<div class="quick-grid">
    <a href="{{ route('jadwal') }}" class="quick-link"><i class="fa-solid fa-clock"></i><strong>Jadwal salat</strong><small>Hari ini</small></a>
    <a href="{{ route('kegiatan') }}" class="quick-link"><i class="fa-solid fa-star"></i><strong>Kegiatan</strong><small>Agenda masjid</small></a>
    <a href="{{ route('donasi') }}" class="quick-link"><i class="fa-solid fa-heart"></i><strong>Donasi</strong><small>Program berjalan</small></a>
    <a href="{{ route('laporan') }}" class="quick-link"><i class="fa-solid fa-chart-column"></i><strong>Laporan</strong><small>Transparansi DKM</small></a>
</div>
<div class="dashboard-columns">
    <section>
        <div class="section-heading">
            <h2>Jadwal salat hari ini</h2><a href="{{ route('jadwal') }}">Buka jadwal</a>
        </div>
        <div class="content-card prayer-list">
            <div class="prayer-line current"><strong>Asar</strong><b>15:09</b><span>Berikutnya</span></div>
            <div class="prayer-line"><strong>Maghrib</strong><b>17:58</b><span>Nanti</span></div>
            <div class="prayer-line"><strong>Isya</strong><b>19:07</b><span>Nanti</span></div>
            <div class="prayer-line"><strong>Subuh</strong><b>04:46</b><span>Besok</span></div>
        </div>
    </section>
    <section>
        <div class="section-heading">
            <h2>Agenda terdekat</h2><a href="{{ route('kegiatan') }}">Semua</a>
        </div>
        <div class="content-card event-list">
            <div class="event-row"><time><b>27</b><small>AGS</small></time>
                <div><strong>Kajian Kamis</strong><span>Ba'da Maghrib · Masjid utama</span></div>
            </div>
            <div class="event-row"><time><b>30</b><small>AGS</small></time>
                <div><strong>Kerja bakti lingkungan</strong><span>07:00 · Halaman masjid</span></div>
            </div>
            <div class="event-row"><time><b>06</b><small>SEP</small></time>
                <div><strong>Santunan anak yatim</strong><span>09:00 · Aula serbaguna</span></div>
            </div>
        </div>
    </section>
</div>
@endsection