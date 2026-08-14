<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Warga | Masjid Jami Cicangkudu</title>

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

            <a href="{{ route('informasi') }}">
                <i class="fa-solid fa-mosque"></i>
                Informasi Masjid
            </a>

            <a href="{{ route('profil') }}" class="active">
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
    MAIN CONTENT
    ========================= -->

    <main class="main-content">


        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-title">
                Profil Warga
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
                    Profil Warga
                </h2>

                <p>
                    Kelola informasi akun warga Masjid Jami Cicangkudu.
                </p>

            </div>



            <!-- =========================
            PROFILE CARD
            ========================= -->

            <div class="profile-wrapper">


                <!-- PROFILE HEADER -->

                <div class="profile-header">

                    <div class="profile-avatar">

                        <i class="fa-solid fa-user"></i>

                    </div>


                    <div>

                        <h4>
                            Nama Warga
                        </h4>

                        <span>
                            Akun Warga
                        </span>

                    </div>

                </div>



                <!-- =========================
                DATA DIRI
                ========================= -->

                <div class="profile-section">

                    <div class="profile-section-title">

                        <i class="fa-solid fa-id-card"></i>

                        <h5>
                            Informasi Pribadi
                        </h5>

                    </div>


                    <div class="row g-4">


                        <!-- NAMA -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="Nama Warga"
                            >

                        </div>



                        <!-- EMAIL -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                value="warga@email.com"
                            >

                        </div>



                        <!-- NOMOR HP -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nomor HP
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Masukkan nomor HP"
                            >

                        </div>



                        <!-- ALAMAT -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Alamat
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Masukkan alamat"
                            >

                        </div>


                    </div>

                </div>



                <!-- =========================
                AKUN
                ========================= -->

                <div class="profile-section">

                    <div class="profile-section-title">

                        <i class="fa-solid fa-lock"></i>

                        <h5>
                            Informasi Akun
                        </h5>

                    </div>


                    <div class="row g-4">


                        <!-- USERNAME -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="warga"
                            >

                        </div>



                        <!-- PASSWORD -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                value="password"
                            >

                        </div>


                    </div>

                </div>



                <!-- =========================
                ACTION
                ========================= -->

                <div class="profile-actions">

                    <button
                        type="button"
                        class="btn btn-success">

                        <i class="fa-solid fa-floppy-disk me-1"></i>

                        Simpan Perubahan

                    </button>


                    <a
                        href="{{ route('dashboard') }}"
                        class="btn btn-outline-secondary">

                        <i class="fa-solid fa-arrow-left me-1"></i>

                        Kembali

                    </a>

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