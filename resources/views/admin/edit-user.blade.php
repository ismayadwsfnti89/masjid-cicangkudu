@extends('admin.layout')

@section('title', 'Edit Pengguna | Admin Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.users') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Pengguna
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Edit Data Pengguna</h2>
        <p class="text-muted mb-0">Perbarui informasi lengkap, nomor kontak, alamat, atau peran pengguna sistem.</p>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email / Kontak</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label fw-semibold">Nomor HP</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->wargaProfile?->no_hp) }}">
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4"><label class="form-label fw-semibold">NIK</label><input name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $user->wargaProfile?->nik) }}">@error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-4"><label class="form-label fw-semibold">No. KK</label><input name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" value="{{ old('no_kk', $user->wargaProfile?->family?->no_kk) }}">@error('no_kk')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-4"><label class="form-label fw-semibold">Golongan kas</label><select name="golongan" class="form-select"><option value="1" @selected((int) old('golongan', $user->wargaProfile?->family?->golongan) === 1)>Golongan 1 — Rp3.000</option><option value="2" @selected((int) old('golongan', $user->wargaProfile?->family?->golongan) === 2)>Golongan 2 — Rp5.000</option><option value="3" @selected((int) old('golongan', $user->wargaProfile?->family?->golongan) === 3)>Golongan 3 — Rp10.000</option></select></div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->wargaProfile?->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="form-label fw-semibold">Peran (Role)</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                    <option value="warga" {{ (old('role', $user->role) == 'warga') ? 'selected' : '' }}>Warga</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
