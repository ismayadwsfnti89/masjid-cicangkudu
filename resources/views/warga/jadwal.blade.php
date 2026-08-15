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

    <!-- =========================
         SIDEBAR
    ========================= -->
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

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="sidebar-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
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
                Jadwal Salat
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

            <!-- HEADER -->
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


            <!-- =========================
                 TANGGAL
            ========================= -->
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


            <!-- =========================
                 JADWAL SALAT
            ========================= -->
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


            <!-- =========================
                 INFORMASI
            ========================= -->
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

        </section>


        <!-- =========================
             FOOTER
        ========================= -->
        <footer class="dashboard-footer">

            © 2026 Masjid Jami Cicangkudu

        </footer>

    </main>


    <!-- =========================
         BOOTSTRAP JS
    ========================= -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- =========================
         API JADWAL SALAT
    ========================= -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * ==============================
             * TANGGAL HARI INI
             * ==============================
             */

            const today = new Date();

            const day = String(today.getDate()).padStart(2, '0');

            const month = String(today.getMonth() + 1).padStart(2, '0');

            const year = today.getFullYear();


            /*
             * ==============================
             * FORMAT TANGGAL INDONESIA
             * ==============================
             */

            const tanggal = today.toLocaleDateString('id-ID', {

                weekday: 'long',

                day: 'numeric',

                month: 'long',

                year: 'numeric'

            });


            document.getElementById('tanggalHariIni').textContent = tanggal;


            /*
             * ==============================
             * LOKASI CICANGKUDU
             * ==============================
             *
             * Untuk sementara menggunakan
             * koordinat wilayah Cicangkudu.
             *
             * Nanti bisa diganti dengan
             * koordinat tepat Masjid Jami Cicangkudu.
             */

            const latitude = -6.9;

            const longitude = 107.6;


            /*
             * ==============================
             * URL API
             * ==============================
             */

            const apiUrl =
                `https://api.aladhan.com/v1/timings/${day}-${month}-${year}?latitude=${latitude}&longitude=${longitude}&method=20`;


            /*
             * ==============================
             * AMBIL DATA API
             * ==============================
             */

            fetch(apiUrl)

                .then(response => {

                    if (!response.ok) {

                        throw new Error(
                            'Gagal terhubung ke server API.'
                        );

                    }

                    return response.json();

                })

                .then(result => {

                    /*
                     * Pastikan API berhasil
                     */

                    if (result.code !== 200) {

                        throw new Error(
                            'Data jadwal salat tidak tersedia.'
                        );

                    }


                    /*
                     * Ambil data waktu salat
                     */

                    const timings = result.data.timings;


                    /*
                     * Tampilkan waktu
                     */

                    document.getElementById('subuh').textContent =
                        timings.Fajr.substring(0, 5);


                    document.getElementById('dzuhur').textContent =
                        timings.Dhuhr.substring(0, 5);


                    document.getElementById('ashar').textContent =
                        timings.Asr.substring(0, 5);


                    document.getElementById('maghrib').textContent =
                        timings.Maghrib.substring(0, 5);


                    document.getElementById('isya').textContent =
                        timings.Isha.substring(0, 5);

                })


                /*
                 * ==============================
                 * JIKA API ERROR
                 * ==============================
                 */

                .catch(error => {

                    console.error(
                        'Jadwal salat:',
                        error
                    );


                    document.getElementById('subuh').textContent =
                        '--:--';


                    document.getElementById('dzuhur').textContent =
                        '--:--';


                    document.getElementById('ashar').textContent =
                        '--:--';


                    document.getElementById('maghrib').textContent =
                        '--:--';


                    document.getElementById('isya').textContent =
                        '--:--';

                });

        });

    </script>

</body>

</html>