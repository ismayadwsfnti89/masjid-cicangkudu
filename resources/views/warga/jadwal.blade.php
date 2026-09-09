@extends('warga.layout')

@section('title', 'Jadwal Salat Bulanan | Masjid Jami Cicangkudu')

@section('content')
<!-- Tombol Kembali & Header Section -->
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Jadwal Salat Sebulan Penuh</h2>
            <p class="text-muted mb-0">Jadwal salat bulanan Masjid Jami Cicangkudu.</p>
        </div>
        <span id="labelBulanTahun" class="badge bg-success px-3 py-2 fs-6" style="border-radius: 0.75rem;">Memuat bulan...</span>
    </div>
</div>

<!-- Content Card: Tabel Jadwal Salat Bulanan -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; background-color: #ffffff;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th class="text-start">Tanggal</th>
                        <th>Hari</th>
                        <th>Imsak</th>
                        <th>Subuh</th>
                        <th>Dzuhur</th>
                        <th>Ashar</th>
                        <th>Maghrib</th>
                        <th>Isya</th>
                    </tr>
                </thead>
                <tbody id="tabelJadwalBulanan">
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Memuat data jadwal sebulan penuh...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Informasi Card -->
<div class="card border-0 shadow-sm" style="border-radius: 1rem; background-color: #e8f5e9;">
    <div class="card-body p-4 d-flex align-items-start">
        <div class="me-3 text-success fs-5 mt-1">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <div>
            <strong class="fw-bold d-block mb-1 text-dark" style="color: #0b5c3d !important;">Informasi</strong>
            <p class="text-muted mb-0 small">
                Jadwal salat di atas bersumber dari data Kemenag untuk Cicangkudu, Mangunreja, Kabupaten Tasikmalaya, untuk kurun waktu satu bulan penuh.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');

        // Set Label Bulan & Tahun
        const namaBulan = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        document.getElementById('labelBulanTahun').innerText =
            `${namaBulan[today.getMonth()]} ${year}`;

        const jakartaDateParts = new Intl.DateTimeFormat('en-US', {timeZone: 'Asia/Jakarta', year: 'numeric', month: '2-digit', day: '2-digit'}).formatToParts(new Date());
        const part = type => jakartaDateParts.find(item => item.type === type)?.value;
        const todayIso = `${part('year')}-${part('month')}-${part('day')}`;

        // ID wilayah
        const idWilayah = '1218';

        // Ambil jadwal 1 bulan penuh
        const url =
            `https://api.myquran.com/v2/sholat/jadwal/${idWilayah}/${year}/${month}`;

        fetch(url)
            .then(response => response.json())
            .then(result => {

                if (result && result.status && result.data && result.data.jadwal) {

                    const listJadwal = result.data.jadwal;
                    let rows = '';

                    listJadwal.forEach(item => {

                        const itemDate = new Date(`${item.date}T12:00:00+07:00`);
                        const hari = new Intl.DateTimeFormat('id-ID', {weekday: 'long', timeZone: 'Asia/Jakarta'}).format(itemDate);
                        const isToday = item.date === todayIso ? 'table-success fw-bold' : '';

                        rows += `
                            <tr class="${isToday}">
                                <td class="text-start">${item.tanggal ?? '-'}</td>
                                <td><span class="${item.date === todayIso ? 'badge bg-success' : 'text-muted'}">${hari}${item.date === todayIso ? ' · Hari ini' : ''}</span></td>
                                <td>${item.imsak ?? '-'}</td>
                                <td>${item.subuh ?? '-'}</td>
                                <td>${item.dzuhur ?? '-'}</td>
                                <td>${item.ashar ?? '-'}</td>
                                <td>${item.maghrib ?? '-'}</td>
                                <td>${item.isya ?? '-'}</td>
                            </tr>
                        `;
                    });

                    document.getElementById('tabelJadwalBulanan').innerHTML = rows;

                } else {

                    document.getElementById('tabelJadwalBulanan').innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center text-danger py-4">
                                Gagal memuat data jadwal bulanan.
                            </td>
                        </tr>
                    `;
                }

            })
            .catch(error => {

                console.error("Gagal mengambil data:", error);

                document.getElementById('tabelJadwalBulanan').innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-danger py-4">
                            Terjadi kesalahan koneksi ke server jadwal.
                        </td>
                    </tr>
                `;
            });

    });
</script>
@endpush
@endsection
