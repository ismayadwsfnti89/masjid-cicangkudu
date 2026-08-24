@extends('warga.layout')
@section('title', 'Informasi Masjid | Masjid Jami Cicangkudu')
@section('header', 'Informasi Masjid')
@section('content')
PAGE HEADER
<div class="page-header">
    <h2>
        Informasi Masjid
    </h2>
    <p>
        Informasi mengenai Masjid Jami Cicangkudu.
    </p>
</div>
PROFILE MASJID
<div class="mosque-profile">
    <div class="mosque-profile-icon">
        <i class="fa-solid fa-mosque"></i>
    </div>
    <div>
        <h2>
            Masjid Jami Cicangkudu
        </h2>
        <p>
            Pusat kegiatan ibadah dan kegiatan
            masyarakat di lingkungan Cicangkudu.
        </p>
    </div>
</div>
<div class="row g-4 mt-1">
    <!-- TENTANG -->
    <div class="col-lg-6">
        <div class="information-card">
            <h5>
                <i class="fa-solid fa-circle-info me-2"></i>


            </h5>
            <p>

                Masjid Jami Cicangkudu merupakan
                tempat ibadah sekaligus pusat kegiatan
                keagamaan masyarakat.

            </p>
            <p>

                Sistem digital ini dibuat untuk
                membantu warga memperoleh informasi
                mengenai kegiatan, jadwal salat,
                donasi, serta laporan keuangan masjid
                dengan lebih mudah.

            </p>
        </div>
    </div>
    <!-- KONTAK -->
    <div class="col-lg-6">
        <div class="information-card">
            <h5>
                <i class="fa-solid fa-address-card me-2"></i>


            </h5>
            <div class="contact-item">
                <i class="fa-solid fa-location-dot"></i>
                <span>
                    Cicangkudu, Indonesia
                </span>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-phone"></i>
                <span>
                    Nomor kontak pengurus
                </span>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-envelope"></i>
                <span>
                    Email pengurus masjid
                </span>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-clock"></i>
                <span>
                    Terbuka untuk kegiatan masyarakat
                </span>
            </div>
        </div>
    </div>
    <!-- VISI -->
    <div class="col-lg-6">
        <div class="information-card">
            <div class="vision-card">
                <div class="information-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <h5>
                        Visi
                    </h5>
                    <p>

                        Mewujudkan masjid sebagai pusat
                        ibadah, pendidikan, dan kegiatan
                        sosial masyarakat yang bermanfaat.

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- MISI -->
    <div class="col-lg-6">
        <div class="information-card">
            <div class="vision-card">
                <div class="information-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <div>
                    <h5>
                        Misi
                    </h5>
                    <p>

                        Meningkatkan pelayanan kepada
                        jamaah serta mendukung kegiatan
                        keagamaan dan sosial masyarakat.

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
FASILITAS
<div class="information-card mt-4">
    <h5>
        <i class="fa-solid fa-building me-2"></i>

        Fasilitas Masjid

    </h5>
    <div class="row g-3 mt-1">
        <div class="col-6 col-md-3">
            <div class="facility-item">
                <i class="fa-solid fa-mosque"></i>
                <span>
                    Ruang Salat
                </span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="facility-item">
                <i class="fa-solid fa-book-quran"></i>
                <span>
                    Pendidikan Al-Qur'an
                </span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="facility-item">
                <i class="fa-solid fa-restroom"></i>
                <span>
                    Tempat Wudhu
                </span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="facility-item">
                <i class="fa-solid fa-users"></i>
                <span>
                    Ruang Kegiatan
                </span>
            </div>
        </div>
    </div>
</div>
@endsection