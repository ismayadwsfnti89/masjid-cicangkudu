@extends('admin.layout')

@section('title', 'Kelola Warga | Admin Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Kelola Data Warga</h2>
        <p class="text-muted mb-0">Daftar seluruh warga yang terdaftar atau diimport ke dalam sistem.</p>
    </div>
    
    <div class="d-flex gap-2">
        @if(Route::has('admin.users.create'))
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-3 py-2 fw-semibold" style="border-radius: 0.75rem;">
                <i class="fa-solid fa-user-plus me-1"></i> Tambah Warga
            </a>
        @endif

        @if(Route::has('admin.import-warga'))
            <a href="{{ route('admin.import-warga') }}" class="btn btn-success px-3 py-2 fw-semibold" style="border-radius: 0.75rem;">
                <i class="fa-solid fa-file-excel me-1"></i> Import Warga
            </a>
        @endif
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius:1rem"><div class="card-body p-3"><form method="GET" class="row g-2 align-items-end"><div class="col-md-4"><label class="form-label small">Cari Nomor Urut Warga</label><input name="cari" type="number" min="1" class="form-control" value="{{ $cari }}" placeholder="Contoh: 12"></div><div class="col-md-2"><button class="btn btn-outline-success w-100"><i class="fa-solid fa-magnifying-glass me-1"></i>Cari</button></div></form></div></div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th><input id="selectAllUsers" type="checkbox" class="form-check-input" title="Pilih semua warga"></th>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username / Email</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $user->id }}" form="bulkDeleteUsers" class="form-check-input user-checkbox"></td>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->username ?? $user->email ?? '-' }}</td>
                        <td>{{ $user->wargaProfile?->no_hp ?? '-' }}</td>
                        <td>{{ $user->wargaProfile?->alamat ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    @if(Route::has('admin.users.edit'))
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 0.5rem;" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endif

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data warga ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 0.5rem;" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data warga yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body pt-0">
        <form id="bulkDeleteUsers" action="{{ route('admin.users.bulk-destroy') }}" method="POST" onsubmit="return confirm('Hapus semua warga yang dipilih? Akun dan profil mereka tidak dapat dikembalikan.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-trash me-1"></i> Hapus warga terpilih
            </button>
            <span class="text-muted small ms-2">Pilih warga dari tabel terlebih dahulu.</span>
        </form>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('selectAllUsers')?.addEventListener('change', function () {
    document.querySelectorAll('.user-checkbox').forEach(item => item.checked = this.checked);
});
</script>
@endpush
@endsection
