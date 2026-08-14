<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal Salat | Masjid Jami Cicangkudu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="fa-solid fa-mosque"></i>
            <span>Masjid Jami Cicangkudu</span>
        </a>

        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('jadwal') }}" class="active">
                <i class="fa-solid fa-clock"></i>
                Jadwal Salat
            </a>

            <a href="{{ route('kegiatan') }}">
                <i class="fa-solid fa-calendar-days"></i>
                Kegiatan
            </a>

            <a href="{{ route('donasi') }}">
                <i class="fa-solid fa-hand-holding-heart"></i>
                Donasi
            </a>

            <a href="{{ route('laporan') }}">
                <i class="fa-solid fa-chart-column"></i>
                Laporan
            </a>

            <a href="{{ route('informasi') }}">
                <i class="fa-solid fa-mosque"></i>
                Informasi Masjid
            </a>

            <a href="{{ route('profil') }}">
                <i class="fa-solid fa-user"></i>
                Profil Warga
            </a>

            <a href="{{ route('login') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-title">
                Jadwal Salat
            </div>

            <div class="topbar-user">
                <i class="fa-solid fa-user"></i>
                Warga
            </div>

        </header>


        <!-- CONTENT -->
        <section class="page-content">

            <div class="page-header">

                <a href="{{ route('dashboard') }}" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>

                <h2>Jadwal Salat</h2>

                <p>
                    Jadwal salat Masjid Jami Cicangkudu.
                </p>

            </div>


            <!-- TANGGAL -->
            <div class="date-card mb-4">

                <i class="fa-solid fa-calendar-day"></i>

                <div>

                    <span class="date-label">
                        Hari ini
                    </span>

                    <h5>
                        Senin, 12 Agustus 2026
                    </h5>

                </div>

            </div>


            <!-- JADWAL -->
            <div class="content-card">

                <h4 class="section-title">
                    Jadwal Salat Hari Ini
                </h4>

                <p class="section-description">
                    Waktu salat dapat menyesuaikan dengan jadwal
                    yang digunakan oleh Masjid Jami Cicangkudu.
                </p>


                <div class="row g-4">


                    <!-- SUBUH -->
                    <div class="col-md-6 col-lg-4">

                        <div class="prayer-card">

                            <div class="prayer-icon">
                                <i class="fa-solid fa-cloud-sun"></i>
                            </div>

                            <div class="prayer-info">

                                <span>
                                    Subuh
                                </span>

                                <strong>
                                    04:45
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- DZUHUR -->
                    <div class="col-md-6 col-lg-4">

                        <div class="prayer-card">

                            <div class="prayer-icon">
                                <i class="fa-solid fa-sun"></i>
                            </div>

                            <div class="prayer-info">

                                <span>
                                    Dzuhur
                                </span>

                                <strong>
                                    12:00
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- ASHAR -->
                    <div class="col-md-6 col-lg-4">

                        <div class="prayer-card">

                            <div class="prayer-icon">
                                <i class="fa-solid fa-cloud-sun"></i>
                            </div>

                            <div class="prayer-info">

                                <span>
                                    Ashar
                                </span>

                                <strong>
                                    15:15
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- MAGHRIB -->
                    <div class="col-md-6 col-lg-4">

                        <div class="prayer-card">

                            <div class="prayer-icon">
                                <i class="fa-solid fa-cloud-sun"></i>
                            </div>

                            <div class="prayer-info">

                                <span>
                                    Maghrib
                                </span>

                                <strong>
                                    18:00
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- ISYA -->
                    <div class="col-md-6 col-lg-4">

                        <div class="prayer-card">

                            <div class="prayer-icon">
                                <i class="fa-solid fa-moon"></i>
                            </div>

                            <div class="prayer-info">

                                <span>
                                    Isya
                                </span>

                                <strong>
                                    19:10
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CATATAN -->
            <div class="prayer-note mt-4">

                <i class="fa-solid fa-circle-info"></i>

                <div>

                    <strong>
                        Informasi
                    </strong>

                    <p>
                        Jadwal di atas merupakan contoh untuk
                        prototype dan nantinya dapat diubah
                        melalui sistem admin.
                    </p>

                </div>

            </div>

        </section>


        <!-- FOOTER -->
        <footer class="dashboard-footer">
            © 2026 Masjid Jami Cicangkudu
        </footer>

    </main>


    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>