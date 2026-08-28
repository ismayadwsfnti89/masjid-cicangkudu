@extends('warga.layout')

@section('title', 'Kegiatan | Masjid Jami Cicangkudu')

@section('content')
<!-- Tombol Kembali & Header Section -->
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Kegiatan</h2>
            <p class="text-muted mb-0">Informasi kegiatan dan program Masjid Jami Cicangkudu.</p>
        </div>
        <span class="text-muted small d-none d-md-inline">Program & Jadwal Resmi</span>
    </div>
</div>

<!-- SECTION: PROGRAM KEGIATAN -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-heading mb-0">
            <h4 class="fw-bold mb-0 text-dark">Program Kegiatan</h4>
        </div>
        <span class="text-muted small">Pilih kegiatan dan program yang ingin kamu ikuti</span>
    </div>

    <!-- Content Grid: Daftar Kegiatan -->
    <div class="row g-4">
        <!-- KEGIATAN 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Pendidikan</span>
                    <h5 class="fw-bold mb-2">Kajian Rutin</h5>
                    <p class="text-muted small mb-4">Kajian rutin untuk jamaah dan masyarakat sekitar Masjid Jami Cicangkudu.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>Setiap Sabtu</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>19.30 WIB</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEGIATAN 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-children"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Sosial</span>
                    <h5 class="fw-bold mb-2">Santunan Anak Yatim</h5>
                    <p class="text-muted small mb-4">Kegiatan santunan dan pemberian bantuan kepada anak yatim di sekitar masjid.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>15 Agustus 2026</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>09.00 WIB</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEGIATAN 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-quran"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Keagamaan</span>
                    <h5 class="fw-bold mb-2">Tadarus Al-Qur'an</h5>
                    <p class="text-muted small mb-4">Kegiatan membaca Al-Qur'an bersama jamaah dan masyarakat sekitar masjid.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>Setiap Malam</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>Setelah Maghrib</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEGIATAN 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Masyarakat</span>
                    <h5 class="fw-bold mb-2">Kerja Bakti Masjid</h5>
                    <p class="text-muted small mb-4">Kegiatan membersihkan area masjid bersama warga dan jamaah.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>Minggu Pagi</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>07.00 WIB</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEGIATAN 5 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-moon"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Keagamaan</span>
                    <h5 class="fw-bold mb-2">Kajian Bulanan</h5>
                    <p class="text-muted small mb-4">Kajian keislaman bersama ustaz dan jamaah Masjid Jami Cicangkudu.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>Setiap Bulan</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>19.30 WIB</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEGIATAN 6 -->
        <div class="col-md-6 col-lg-4">
            <div class="content-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="donation-icon mb-3 text-success fs-3">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <span class="badge bg-light text-success mb-2">Sosial</span>
                    <h5 class="fw-bold mb-2">Berbagi Sembako</h5>
                    <p class="text-muted small mb-4">Program pembagian sembako untuk membantu masyarakat yang membutuhkan.</p>
                </div>
                <div class="text-muted small pt-3 border-top border-light">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-calendar me-2 text-secondary" style="width: 14px;"></i>
                        <span>20 Agustus 2026</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <i class="fa-solid fa-clock me-2 text-secondary" style="width: 14px;"></i>
                        <span>09.00 WIB</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-location-dot me-2 text-secondary" style="width: 14px;"></i>
                        <span>Masjid Jami Cicangkudu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION: INFORMASI -->
<div>
    <div class="content-card bg-light border-0">
        <h4 class="section-title fw-bold fs-5 mb-2" style="color: #0b5c3d;">Informasi Kegiatan</h4>
        <p class="text-muted mb-0 small">
            Jadwal kegiatan pada halaman ini merupakan data prototype. Nantinya admin dapat menambahkan, mengubah, dan menghapus kegiatan melalui dashboard admin.
        </p>
    </div>
</div>
@endsection