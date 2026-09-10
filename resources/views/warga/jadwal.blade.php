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

<form id="filterJadwal" class="card border-0 shadow-sm mb-4" style="border-radius:1rem;">
    <div class="card-body p-3">
        <div class="row g-3 align-items-end">
            <div class="col-sm-5 col-md-4">
                <label for="pilihBulan" class="form-label fw-semibold mb-1">Bulan</label>
                <select id="pilihBulan" class="form-select"></select>
            </div>
            <div class="col-sm-5 col-md-3">
                <label for="pilihTahun" class="form-label fw-semibold mb-1">Tahun</label>
                <select id="pilihTahun" class="form-select"></select>
            </div>
            <div class="col-sm-2 col-md-auto">
                <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-calendar-check me-1"></i>Tampilkan</button>
            </div>
        </div>
        <div class="form-text mt-2">Pilih bulan dan tahun untuk membuka jadwal salat terdahulu selama data tersedia dari API.</div>
    </div>
</form>

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
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date();
    const params = new URLSearchParams(window.location.search);
    const namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const tahunSekarang = today.getFullYear();
    const bulanAwal = Number(params.get('bulan')) || today.getMonth() + 1;
    const tahunAwal = Number(params.get('tahun')) || tahunSekarang;
    const pilihBulan = document.getElementById('pilihBulan');
    const pilihTahun = document.getElementById('pilihTahun');
    const tabel = document.getElementById('tabelJadwalBulanan');

    namaBulan.forEach((nama, index) => pilihBulan.add(new Option(nama, index + 1, false, index + 1 === bulanAwal)));
    for (let tahun = tahunSekarang + 1; tahun >= 2016; tahun--) {
        pilihTahun.add(new Option(tahun, tahun, false, tahun === tahunAwal));
    }

    const bagianTanggalJakarta = new Intl.DateTimeFormat('en-US', { timeZone: 'Asia/Jakarta', year: 'numeric', month: '2-digit', day: '2-digit' }).formatToParts(new Date());
    const tanggalHariIni = tipe => bagianTanggalJakarta.find(item => item.type === tipe)?.value;
    const todayIso = `${tanggalHariIni('year')}-${tanggalHariIni('month')}-${tanggalHariIni('day')}`;

    function muatJadwal() {
        const tahun = pilihTahun.value;
        const bulan = pilihBulan.value;
        document.getElementById('labelBulanTahun').innerText = `${namaBulan[bulan - 1]} ${tahun}`;
        tabel.innerHTML = '<tr><td colspan="8" class="text-center text-muted py-4">Memuat data jadwal sebulan penuh...</td></tr>';
        const url = `https://api.myquran.com/v2/sholat/jadwal/1218/${tahun}/${String(bulan).padStart(2, '0')}`;

        fetch(url)
            .then(response => response.json())
            .then(result => {
                if (!result?.status || !result?.data?.jadwal) throw new Error('Data jadwal tidak tersedia');

                tabel.innerHTML = result.data.jadwal.map(item => {
                    const itemDate = new Date(`${item.date}T12:00:00+07:00`);
                    const hari = new Intl.DateTimeFormat('id-ID', { weekday: 'long', timeZone: 'Asia/Jakarta' }).format(itemDate);
                    const isToday = item.date === todayIso;
                    return `<tr class="${isToday ? 'table-success fw-bold' : ''}">
                        <td class="text-start">${item.tanggal ?? '-'}</td>
                        <td><span class="${isToday ? 'badge bg-success' : 'text-muted'}">${hari}${isToday ? ' · Hari ini' : ''}</span></td>
                        <td>${item.imsak ?? '-'}</td><td>${item.subuh ?? '-'}</td><td>${item.dzuhur ?? '-'}</td>
                        <td>${item.ashar ?? '-'}</td><td>${item.maghrib ?? '-'}</td><td>${item.isya ?? '-'}</td>
                    </tr>`;
                }).join('');
            })
            .catch(() => {
                tabel.innerHTML = '<tr><td colspan="8" class="text-center text-danger py-4">Jadwal untuk bulan dan tahun ini belum tersedia dari API.</td></tr>';
            });
    }

    document.getElementById('filterJadwal').addEventListener('submit', event => {
        event.preventDefault();
        const paramsBaru = new URLSearchParams({ bulan: pilihBulan.value, tahun: pilihTahun.value });
        window.history.replaceState({}, '', `${window.location.pathname}?${paramsBaru}`);
        muatJadwal();
    });

    muatJadwal();
});
</script>
@endpush
@endsection
