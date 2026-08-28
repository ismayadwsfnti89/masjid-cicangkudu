@extends('warga.layout')

@section('title', 'Informasi Masjid | Masjid Jami Cicangkudu')

@section('content')
<!-- Tombol Kembali & Header Section -->
<div class="mb-4">
    <a href="#" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Informasi Masjid</h2>
            <p class="text-muted mb-0">Informasi profil, visi misi, serta fasilitas Masjid Jami Cicangkudu.</p>
        </div>
        <span class="text-muted small d-none d-md-inline">Profil & Fasilitas Resmi</span>
    </div>
</div>

<!-- Hero Banner Profil Masjid (Model Kartu Putih Minimalis) -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; background-color: #ffffff;">
    <div class="card-body p-4 p-md-4 d-flex align-items-center">
        <div class="me-3 d-flex align-items-center justify-content-center rounded-3" style="width: 60px; height: 60px; min-width: 60px; background-color: #e8f5e9; color: #0b5c3d;">
            <i class="fa-solid fa-mosque fa-xl"></i>
        </div>
        <div>
            <span class="badge bg-success bg-opacity-15 text-success mb-1" style="font-size: 0.7rem;">Pusat Ibadah & Masyarakat</span>
            <h4 class="fw-bold mb-1 text-dark">Masjid Jami Cicangkudu</h4>
            <p class="text-muted mb-0 small" style="max-width: 600px;">
                Pusat kegiatan ibadah dan kegiatan masyarakat di lingkungan Cicangkudu. Sistem digital ini dibuat untuk memudahkan warga mengakses informasi masjid.
            </p>
        </div>
    </div>
</div>

<!-- Grid Informasi (Tentang & Kontak) -->
<div class="row g-4 mb-4">
    <!-- Tentang Masjid -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background-color: #ffffff;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Tentang Masjid</h5>
                </div>
                <p class="text-muted small mb-2">
                    Masjid Jami Cicangkudu merupakan tempat ibadah sekaligus pusat kegiatan keagamaan masyarakat sekitar.
                </p>
                <p class="text-muted small mb-0">
                    Hadir dengan sistem digital untuk membantu warga memperoleh informasi kegiatan, jadwal salat, donasi, serta laporan keuangan secara transparan.
                </p>
            </div>
        </div>
    </div>

    <!-- Kontak Pengurus -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background-color: #ffffff;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: #e8f5e9; color: #0b5c3d;">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Kontak Pengurus</h5>
                </div>
                <div class="d-flex align-items-center mb-2 text-muted small">
                    <i class="fa-solid fa-location-dot me-3 text-success" style="width: 16px; text-align: center;"></i>
                    <span>Cicangkudu, Indonesia</span>
                </div>
                <div class="d-flex align-items-center mb-2 text-muted small">
                    <i class="fa-solid fa-phone me-3 text-success" style="width: 16px; text-align: center;"></i>
                    <span>Nomor kontak pengurus tersedia</span>
                </div>
                <div class="d-flex align-items-center mb-2 text-muted small">
                    <i class="fa-solid fa-envelope me-3 text-success" style="width: 16px; text-align: center;"></i>
                    <span>pengurus@cicangkudu.</span>
                </div>
                <div class="d-flex align-items-center text-muted small">
                    <i class="fa-solid fa-clock me-3 text-success" style="width: 16px; text-align: center;"></i>
                    <span>Terbuka untuk kegiatan masyarakat</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grid Visi & Misi -->
<div class="row g-4 mb-4">
    <!-- Visi -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background-color: #ffffff;">
            <div class="card-body p-4 d-flex align-items-start">
                <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px; background-color: #e8f5e9; color: #0b5c3d;">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-2 text-dark">Visi</h5>
                    <p class="text-muted small mb-0">
                        Mewujudkan masjid sebagai pusat ibadah, pendidikan, dan kegiatan sosial masyarakat yang bermanfaat serta berdaya saing.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Misi -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background-color: #ffffff;">
            <div class="card-body p-4 d-flex align-items-start">
                <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px; background-color: #e8f5e9; color: #0b5c3d;">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-2 text-dark">Misi</h5>
                    <p class="text-muted small mb-0">
                        Meningkatkan pelayanan kepada jamaah serta mendukung penuh setiap kegiatan keagamaan dan sosial kemasyarakatan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fasilitas Masjid -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem; background-color: #ffffff;">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: #e8f5e9; color: #0b5c3d;">
                <i class="fa-solid fa-building"></i>
            </div>
            <h5 class="fw-bold mb-0 text-dark">Fasilitas Masjid</h5>
        </div>
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex flex-column align-items-center justify-content-center">
                    <i class="fa-solid fa-mosque fs-3 mb-2" style="color: #0b5c3d;"></i>
                    <div class="fw-semibold text-dark small">Ruang Salat</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex flex-column align-items-center justify-content-center">
                    <i class="fa-solid fa-book-quran fs-3 mb-2" style="color: #0b5c3d;"></i>
                    <div class="fw-semibold text-dark small">Pendidikan Al-Qur'an</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex flex-column align-items-center justify-content-center">
                    <i class="fa-solid fa-restroom fs-3 mb-2" style="color: #0b5c3d;"></i>
                    <div class="fw-semibold text-dark small">Tempat Wudhu</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border-0 rounded-3 bg-light h-100 d-flex flex-column align-items-center justify-content-center">
                    <i class="fa-solid fa-users fs-3 mb-2" style="color: #0b5c3d;"></i>
                    <div class="fw-semibold text-dark small">Ruang Kegiatan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection