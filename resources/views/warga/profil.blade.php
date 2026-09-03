@extends('warga.layout')

@section('title', 'Profil Warga | Masjid Jami Cicangkudu')

@section('content')
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Profil Warga</h2>
            <p class="text-muted mb-0">Kelola informasi akun warga Masjid Jami Cicangkudu.</p>
        </div>
        <span class="text-muted small d-none d-md-inline">Sistem Digital Masjid</span>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4 p-md-5">
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 64px; height: 64px; background-color: #e8f5e9; color: #0b5c3d;">
                    <i class="fa-solid fa-user fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1" style="color: #111d13;">{{ $warga->name ?? 'Nama Warga' }}</h4>
                    <span class="badge bg-success bg-opacity-15 text-success px-2 py-1 small fw-semibold">Akun Warga</span>
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-id-card me-2 fs-5 text-success"></i>
                    <h5 class="fw-bold mb-0" style="color: #111d13;">Informasi Pribadi</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control bg-light border-light py-2" value="{{ old('nama_lengkap', $warga->name ?? '') }}" required />
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-lock me-2 fs-5 text-success"></i>
                    <h5 class="fw-bold mb-0" style="color: #111d13;">Informasi Akun</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-muted">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control bg-light border-light py-2" placeholder="Kosongkan jika tidak ingin mengubah" />
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection+
