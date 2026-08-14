<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Keuangan | Masjid Jami Cicangkudu</title>

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

            <a href="{{ route('laporan') }}" class="active">
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



    <!-- =========================
    MAIN CONTENT
    ========================= -->

    <main class="main-content">


        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-title">
                Laporan Keuangan
            </div>

            <div class="topbar-user">

                <i class="fa-solid fa-user"></i>

                Warga

            </div>

        </header>



        <!-- =========================
        PAGE CONTENT
        ========================= -->

        <section class="page-content">


            <!-- HEADER -->

            <div class="page-header">

                <a href="{{ route('dashboard') }}" class="back-link">

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali ke Dashboard

                </a>


                <h2>
                    Laporan Keuangan
                </h2>


                <p>
                    Transparansi pemasukan dan pengeluaran
                    Masjid Jami Cicangkudu.
                </p>

            </div>



            <!-- =========================
            RINGKASAN KEUANGAN
            ========================= -->

            <div class="row g-4 mb-4">


                <!-- PEMASUKAN -->

                <div class="col-md-6 col-lg-4">

                    <div class="finance-card">

                        <div class="finance-icon income">

                            <i class="fa-solid fa-arrow-down"></i>

                        </div>

                        <div>

                            <span>
                                Total Pemasukan
                            </span>

                            <h4>
                                Rp 12.000.000
                            </h4>

                        </div>

                    </div>

                </div>



                <!-- PENGELUARAN -->

                <div class="col-md-6 col-lg-4">

                    <div class="finance-card">

                        <div class="finance-icon expense">

                            <i class="fa-solid fa-arrow-up"></i>

                        </div>

                        <div>

                            <span>
                                Total Pengeluaran
                            </span>

                            <h4>
                                Rp 4.500.000
                            </h4>

                        </div>

                    </div>

                </div>



                <!-- SALDO -->

                <div class="col-md-6 col-lg-4">

                    <div class="finance-card">

                        <div class="finance-icon balance">

                            <i class="fa-solid fa-wallet"></i>

                        </div>

                        <div>

                            <span>
                                Saldo
                            </span>

                            <h4>
                                Rp 7.500.000
                            </h4>

                        </div>

                    </div>

                </div>

            </div>



            <!-- =========================
            FILTER LAPORAN
            ========================= -->

            <div class="report-filter">

                <div>

                    <h5>
                        Riwayat Transaksi
                    </h5>

                    <p>
                        Daftar pemasukan dan pengeluaran
                        Masjid Jami Cicangkudu.
                    </p>

                </div>


                <select class="form-select">

                    <option>
                        Agustus 2026
                    </option>

                    <option>
                        Juli 2026
                    </option>

                    <option>
                        Juni 2026
                    </option>

                </select>

            </div>



            <!-- =========================
            TABEL LAPORAN
            ========================= -->

            <div class="report-table">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Keterangan
                                </th>

                                <th>
                                    Jenis
                                </th>

                                <th>
                                    Nominal
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <!-- TRANSAKSI 1 -->

                            <tr>

                                <td>
                                    02 Agustus 2026
                                </td>

                                <td>
                                    Donasi Jamaah
                                </td>

                                <td>

                                    <span class="transaction income-label">
                                        Pemasukan
                                    </span>

                                </td>

                                <td class="income-text">
                                    + Rp 2.500.000
                                </td>

                            </tr>



                            <!-- TRANSAKSI 2 -->

                            <tr>

                                <td>
                                    05 Agustus 2026
                                </td>

                                <td>
                                    Pembelian Perlengkapan Masjid
                                </td>

                                <td>

                                    <span class="transaction expense-label">
                                        Pengeluaran
                                    </span>

                                </td>

                                <td class="expense-text">
                                    - Rp 1.000.000
                                </td>

                            </tr>



                            <!-- TRANSAKSI 3 -->

                            <tr>

                                <td>
                                    08 Agustus 2026
                                </td>

                                <td>
                                    Donasi Renovasi Masjid
                                </td>

                                <td>

                                    <span class="transaction income-label">
                                        Pemasukan
                                    </span>

                                </td>

                                <td class="income-text">
                                    + Rp 3.000.000
                                </td>

                            </tr>



                            <!-- TRANSAKSI 4 -->

                            <tr>

                                <td>
                                    10 Agustus 2026
                                </td>

                                <td>
                                    Biaya Listrik dan Air
                                </td>

                                <td>

                                    <span class="transaction expense-label">
                                        Pengeluaran
                                    </span>

                                </td>

                                <td class="expense-text">
                                    - Rp 1.500.000
                                </td>

                            </tr>



                            <!-- TRANSAKSI 5 -->

                            <tr>

                                <td>
                                    12 Agustus 2026
                                </td>

                                <td>
                                    Donasi Masyarakat
                                </td>

                                <td>

                                    <span class="transaction income-label">
                                        Pemasukan
                                    </span>

                                </td>

                                <td class="income-text">
                                    + Rp 1.500.000
                                </td>

                            </tr>



                            <!-- TRANSAKSI 6 -->

                            <tr>

                                <td>
                                    12 Agustus 2026
                                </td>

                                <td>
                                    Perawatan Fasilitas Masjid
                                </td>

                                <td>

                                    <span class="transaction expense-label">
                                        Pengeluaran
                                    </span>

                                </td>

                                <td class="expense-text">
                                    - Rp 2.000.000
                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>



            <!-- =========================
            TRANSPARANSI
            ========================= -->

            <div class="transparency-card">

                <div class="transparency-icon">

                    <i class="fa-solid fa-shield-halved"></i>

                </div>


                <div>

                    <h5>
                        Transparansi Keuangan
                    </h5>

                    <p>
                        Laporan keuangan ditampilkan sebagai
                        bentuk transparansi kepada warga dan
                        jamaah Masjid Jami Cicangkudu.
                        Data pada halaman ini masih berupa
                        data prototype dan nantinya akan
                        dikelola oleh admin.
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



    <!-- Bootstrap JS -->

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>