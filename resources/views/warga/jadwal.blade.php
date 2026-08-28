@extends('warga.layout')

@section('title', 'Jadwal Salat | Masjid Jami Cicangkudu')

@section('content')
<!-- Tombol Kembali & Header Section -->
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Jadwal Salat</h2>
            <p class="text-muted mb-0">Jadwal salat Masjid Jami Cicangkudu.</p>
        </div>
        <span class="text-muted small d-none d-md-inline">Waktu Salat Otomatis</span>
    </div>
</div>

<!-- Date Card -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; background-color: #ffffff;">
    <div class="card-body p-4 d-flex align-items-center">
        <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; min-width: 50px; background-color: #e8f5e9; color: #0b5c3d;">
            <i class="fa-solid fa-calendar-day fs-5"></i>
        </div>
        <div>
            <span class="text-muted small d-block mb-1">Hari ini</span>
            <h5 id="tanggalHariIni" class="fw-bold mb-0 text-dark">Memuat tanggal...</h5>
        </div>
    </div>
</div>

<!-- Content Card: Jadwal Salat Hari Ini -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; background-color: #ffffff;">
    <div class="card-body p-4 p-md-4">
        <h4 class="fw-bold mb-1 text-dark">Jadwal Salat Hari Ini</h4>
        <p class="text-muted mb-4 small">Jadwal salat diperoleh secara otomatis berdasarkan lokasi Masjid Jami Cicangkudu.</p>

        <div class="row g-3">
            <!-- SUBUH -->
            <div class="col-md-6 col-lg-4">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px; min-width: 44px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-cloud-sun"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block" style="font-size: 0.75rem;">Subuh</span>
                        <strong id="subuh" class="fs-5 fw-bold text-dark">--:--</strong>
                    </div>
                </div>
            </div>

            <!-- DZUHUR -->
            <div class="col-md-6 col-lg-4">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px; min-width: 44px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block" style="font-size: 0.75rem;">Dzuhur</span>
                        <strong id="dzuhur" class="fs-5 fw-bold text-dark">--:--</strong>
                    </div>
                </div>
            </div>

            <!-- ASHAR -->
            <div class="col-md-6 col-lg-4">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px; min-width: 44px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-cloud-sun"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block" style="font-size: 0.75rem;">Ashar</span>
                        <strong id="ashar" class="fs-5 fw-bold text-dark">--:--</strong>
                    </div>
                </div>
            </div>

            <!-- MAGHRIB -->
            <div class="col-md-6 col-lg-4">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px; min-width: 44px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-cloud-sun"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block" style="font-size: 0.75rem;">Maghrib</span>
                        <strong id="maghrib" class="fs-5 fw-bold text-dark">--:--</strong>
                    </div>
                </div>
            </div>

            <!-- ISYA -->
            <div class="col-md-6 col-lg-4">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex align-items-center">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 44px; height: 44px; min-width: 44px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-moon"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block" style="font-size: 0.75rem;">Isya</span>
                        <strong id="isya" class="fs-5 fw-bold text-dark">--:--</strong>
                    </div>
                </div>
            </div>
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
                Jadwal salat diperoleh secara otomatis berdasarkan lokasi Masjid Jami Cicangkudu dan diperbarui setiap harinya.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Format tanggal hari ini dalam bahasa Indonesia
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const today = new Date();
        document.getElementById('tanggalHariIni').innerText = today.toLocaleDateString('id-ID', options);

        // Mengambil jadwal salat otomatis menggunakan Aladhan API untuk wilayah Indonesia (menggunakan koordinat umum atau kota/region, cth: Jakarta/Bandung/Nasional via API)
        // Menggunakan endpointgetByDate untuk tanggal hari ini
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();
        const dateStr = `${dd}-${mm}-${yyyy}`;

        // Contoh koordinat wilayah sekitar atau menggunakan endpoint kota (misal: bandung / jakarta sebagai acuan nasional/regional terdekat)
        fetch(`https://api.aladhan.com/v1/timingsByAddress/${dateStr}?address=Bandung,Indonesia&method=11`)
            .then(response => response.json())
            .then(data => {
                if (data && data.code === 200) {
                    const timings = data.data.timings;
                    document.getElementById('subuh').innerText = timings.Fajr;
                    document.getElementById('dzuhur').innerText = timings.Dhuhr;
                    document.getElementById('ashar').innerText = timings.Asr;
                    document.getElementById('maghrib').innerText = timings.Maghrib;
                    document.getElementById('isya').innerText = timings.Isha;
                }
            })
            .catch(error => {
                console.error("Gagal memuat jadwal salat:", error);
            });
    });
</script>
@endpush
@endsection