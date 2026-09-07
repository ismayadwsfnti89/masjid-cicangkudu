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
   @forelse($kegiatan as $item)

    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                {{-- ICON --}}
                <div class="mb-3">
                    <i class="fa-solid fa-calendar-days fs-3 text-success"></i>
                </div>

                {{-- JUDUL --}}
                <h5 class="fw-bold mb-2">
                    {{ $item->title }}
                </h5>

                {{-- DESKRIPSI --}}
                <p class="text-muted small">
                    {{ $item->description }}
                </p>

                <hr>

                {{-- TANGGAL --}}
                @if($item->event_date)
                    <div class="small text-muted mb-2">
                        <i class="fa-solid fa-calendar me-2"></i>

                        {{ $item->event_date->translatedFormat('d F Y') }}
                    </div>
                @endif

                {{-- STATUS --}}
                <div class="small text-success">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    Kegiatan Masjid Jami Cicangkudu
                </div>

            </div>

        </div>

    </div>

@empty

    <div class="col-12">

        <div class="text-center py-5 text-muted">

            <i class="fa-solid fa-calendar-xmark fs-1 mb-3"></i>

            <p class="mb-0">
                Belum ada kegiatan yang tersedia.
            </p>

        </div>

    </div>

@endforelse

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