@extends('warga.layout') 

@section('content')
<div class="container py-4">

    <!-- HERO MASJID -->
    <div class="mosque-hero mb-4">
        <img src="{{ asset('images/masjid.jpg') }}" alt="Masjid Jami Cicangkudu" class="mosque-hero-image">
        
        <div class="mosque-hero-overlay">
            <div class="mosque-hero-content">
                <span class="mosque-badge">
                    <i class="fa-solid fa-mosque"></i>
                    Sistem Digital Masjid
                </span>

                <h2>Assalamu'alaikum 👋</h2>
                <h3>Masjid Jami Cicangkudu</h3>

                <p>
                    Selamat datang di sistem digital Masjid Jami Cicangkudu. 
                    Temukan informasi, kegiatan, jadwal salat, donasi, dan laporan masjid dalam satu tempat.
                </p>

                <a href="{{ route('informasi') }}" class="hero-button">
                    <i class="fa-solid fa-mosque"></i>
                    Tentang Masjid
                </a>
            </div>
        </div>
    </div>

</div>
@endsection