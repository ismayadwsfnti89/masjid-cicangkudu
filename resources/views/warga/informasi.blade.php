<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Informasi Masjid | Masjid Jami Cicangkudu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>


<body>

    <!-- =========================
    SIDEBAR
    ========================= -->

    <aside class="sidebar">

        <a href="{{ route('dashboard') }}" class="sidebar-brand">

            <i class="fa-solid fa-mosque"></i>

            <span>
                Masjid Jami Cicangkudu
            </span>

        </a>


        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('jadwal') }}">
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

            <a href="{{ route('informasi') }}" class="active">
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



    <!-- =========================
    MAIN
    ========================= -->

    <main class="main-content">


        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-title">
                Informasi Masjid
            </div>

            <div class="topbar-user">

                <i class="fa-solid fa-user"></i>

                Warga

            </div>

        </header>



        <!-- =========================
        CONTENT
        ========================= -->

        <section class="page-content">


            <!-- PAGE HEADER -->

            <div class="page-header">

                <h2>
                    Informasi Masjid
                </h2>

                <p>
                    Informasi mengenai Masjid Jami Cicangkudu.
                </p>

            </div>



            <!-- =========================
            PROFILE MASJID
            ========================= -->

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



            <!-- =========================
            INFORMASI UTAMA
            ========================= -->

            <div class="row g-4 mt-1">


                <!-- TENTANG -->

                <div class="col-lg-6">

                    <div class="information-card">

                        <h5>

                            <i class="fa-solid fa-circle-info me-2"></i>

                            Tentang Masjid

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

                            Informasi Kontak

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



            <!-- =========================
            FASILITAS
            ========================= -->

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