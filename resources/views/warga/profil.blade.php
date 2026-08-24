@extends('warga.layout')
@section('title', 'Profil Warga | Masjid Jami Cicangkudu')
@section('header', 'Profil Warga')
@section('content')
PAGE HEADER
<div class="page-header">
    <h2>
        Profil Warga
    </h2>
    <p>
        Kelola informasi akun warga Masjid Jami Cicangkudu.
    </p>
</div>
<div class="profile-wrapper">
    <!-- PROFILE HEADER -->
    <div class="profile-header">
        <div class="profile-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div>
            <h4>
                Nama Warga
            </h4>
            <span>
                Akun Warga
            </span>
        </div>
    </div>
    <!-- =========================
                ========================= -->
    <div class="profile-section">
        <div class="profile-section-title">
            <i class="fa-solid fa-id-card"></i>
            <h5>
                Informasi Pribadi
            </h5>
        </div>
        <div class="row g-4">
            <!-- NAMA -->
            <div class="col-md-6">
                <label class="form-label">
                    Nama Lengkap
                </label>
                <input class="form-control" type="text" value="Nama Warga" />
            </div>
            <!-- EMAIL -->
            <div class="col-md-6">
                <label class="form-label">
                    Email
                </label>
                <input class="form-control" type="email" value="warga@email.com" />
            </div>
            <!-- NOMOR HP -->
            <div class="col-md-6">
                <label class="form-label">
                    Nomor HP
                </label>
                <input class="form-control" placeholder="Masukkan nomor HP" type="text" />
            </div>
            <!-- ALAMAT -->
            <div class="col-md-6">
                <label class="form-label">
                    Alamat
                </label>
                <input class="form-control" placeholder="Masukkan alamat" type="text" />
            </div>
        </div>
    </div>
    <!-- =========================
                AKUN
                ========================= -->
    <div class="profile-section">
        <div class="profile-section-title">
            <i class="fa-solid fa-lock"></i>
            <h5>
                Informasi Akun
            </h5>
        </div>
        <div class="row g-4">
            <!-- USERNAME -->
            <div class="col-md-6">
                <label class="form-label">
                    Username
                </label>
                <input class="form-control" type="text" value="warga" />
            </div>
            <!-- PASSWORD -->
            <div class="col-md-6">
                <label class="form-label">
                    Password
                </label>
                <input class="form-control" type="password" value="password" />
            </div>
        </div>
    </div>
    <!-- =========================
                ACTION
                ========================= -->
    <div class="profile-actions">
        <button class="btn btn-success" type="button">
            <i class="fa-solid fa-floppy-disk me-1"></i>

            Simpan Perubahan

        </button>
        <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-arrow-left me-1"></i>

            Kembali

        </a>
    </div>
</div>
@endsection