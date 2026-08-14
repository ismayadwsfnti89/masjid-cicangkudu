<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga | Masjid Jami Cicangkudu</title>

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
            <span>Masjid Jami Cicangkudu</span>
        </a>

        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}" class="active">
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

            <a href="{{ route('profil') }}">
                <i class="fa-solid fa-user"></i>
                Profil Warga
            </a>

            <!-- Menu Logout diganti dengan form POST -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="sidebar-logout-btn" style="background: none; border: none; width: 100%; text-align: left; display: flex; align-items: center; padding: 10px 15px; color: inherit; text-decoration: none;">
                    <i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>

    </aside>

    <!-- =========================
    MAIN CONTENT
    ========================= -->
    <main class="main-content">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                Dashboard
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

            <!-- WELCOME -->
            <div class="dashboard-welcome mb-4">
                <h2>Assalamu'alaikum 👋</h2>
                <p>Selamat datang di Sistem Digital Masjid Jami Cicangkudu.</p>
            </div>

            <!-- =========================
            MENU UTAMA
            ========================= -->
            <h5 class="dashboard-section-title">
                Menu Utama
            </h5>

            <div class="row g-4">

                <!-- JADWAL -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h5>Jadwal Salat</h5>
                        <p>Lihat jadwal salat hari ini di Masjid Jami Cicangkudu.</p>
                        <a href="{{ route('jadwal') }}" class="dashboard-link">
                            Lihat Jadwal
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- KEGIATAN -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <h5>Kegiatan</h5>
                        <p>Lihat berbagai kegiatan Masjid Jami Cicangkudu.</p>
                        <a href="{{ route('kegiatan') }}" class="dashboard-link">
                            Lihat Kegiatan
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- DONASI -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h5>Donasi</h5>
                        <p>Lihat program dan informasi donasi masjid.</p>
                        <a href="{{ route('donasi') }}" class="dashboard-link">
                            Lihat Donasi
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- LAPORAN -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-chart-column"></i>
                        </div>
                        <h5>Laporan Keuangan</h5>
                        <p>Lihat laporan pemasukan dan pengeluaran masjid.</p>
                        <a href="{{ route('laporan') }}" class="dashboard-link">
                            Lihat Laporan
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- INFORMASI MASJID -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <h5>Informasi Masjid</h5>
                        <p>Lihat profil dan informasi Masjid Jami Cicangkudu.</p>
                        <a href="{{ route('informasi') }}" class="dashboard-link">
                            Lihat Informasi
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- PROFIL -->
                <div class="col-md-6 col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h5>Profil Warga</h5>
                        <p>Lihat dan kelola informasi akun warga.</p>
                        <a href="{{ route('profil') }}" class="dashboard-link">
                            Lihat Profil
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- =========================
            INFO MASJID
            ========================= -->
            <div class="info-card mt-4">
                <div class="info-icon">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <h5>Masjid Jami Cicangkudu</h5>
                    <p>Satu sistem untuk melihat jadwal salat, kegiatan, donasi, laporan keuangan, informasi masjid, dan profil warga.</p>
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