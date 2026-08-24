@extends('warga.layout')
@section('title', 'Kegiatan | Masjid Jami Cicangkudu')
@section('header', 'Kegiatan')
@section('content')
<div class="page-header">
    <a class="back-link" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>
    <h2>
        Kegiatan Masjid
    </h2>
    <p>
        Informasi kegiatan dan program Masjid Jami Cicangkudu.
    </p>
</div>
<div class="content-card">
    <h4 class="section-title">
        Kegiatan Terbaru
    </h4>
    <p class="section-description">
        Berikut beberapa kegiatan yang diselenggarakan oleh Masjid Jami Cicangkudu.
    </p>
    <div class="row g-4">
        <!-- KEGIATAN 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Pendidikan
                    </span>
                    <h5>
                        Kajian Rutin
                    </h5>
                    <p>
                        Kajian rutin untuk jamaah dan masyarakat sekitar Masjid Jami Cicangkudu.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            Setiap Sabtu
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            19.30 WIB
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- KEGIATAN 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-children"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Sosial
                    </span>
                    <h5>
                        Santunan Anak Yatim
                    </h5>
                    <p>
                        Kegiatan santunan dan pemberian bantuan kepada anak yatim di sekitar masjid.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            15 Agustus 2026
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            09.00 WIB
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- KEGIATAN 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-quran"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Keagamaan
                    </span>
                    <h5>
                        Tadarus Al-Qur'an
                    </h5>
                    <p>
                        Kegiatan membaca Al-Qur'an bersama jamaah dan masyarakat sekitar masjid.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            Setiap Malam
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            Setelah Maghrib
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- KEGIATAN 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Masyarakat
                    </span>
                    <h5>
                        Kerja Bakti Masjid
                    </h5>
                    <p>
                        Kegiatan membersihkan area masjid bersama warga dan jamaah.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            Minggu Pagi
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            07.00 WIB
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- KEGIATAN 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-moon"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Keagamaan
                    </span>
                    <h5>
                        Kajian Bulanan
                    </h5>
                    <p>
                        Kajian keislaman bersama ustaz dan jamaah Masjid Jami Cicangkudu.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            Setiap Bulan
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            19.30 WIB
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- KEGIATAN 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="activity-card">
                <div class="activity-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div class="activity-content">
                    <span class="activity-category">
                        Sosial
                    </span>
                    <h5>
                        Berbagi Sembako
                    </h5>
                    <p>
                        Program pembagian sembako untuk membantu masyarakat yang membutuhkan.
                    </p>
                    <div class="activity-info">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            20 Agustus 2026
                        </span>
                        <span>
                            <i class="fa-solid fa-clock"></i>
                            09.00 WIB
                        </span>
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Masjid Jami Cicangkudu
                        </span>
                    </div>
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
            Informasi Kegiatan
        </strong>
        <p>
            Jadwal kegiatan pada halaman ini merupakan data prototype. Nantinya admin dapat menambahkan, mengubah, dan menghapus kegiatan melalui dashboard admin.
        </p>
    </div>
</div>
@endsection