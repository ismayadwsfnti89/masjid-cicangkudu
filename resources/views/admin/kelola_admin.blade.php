@extends('admin.layout')

@section('title', 'Kelola Admin | Admin Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Kelola Akun Admin</h2>
        <p class="text-muted mb-0">Daftar seluruh pengurus atau admin yang memiliki akses ke sistem.</p>
    </div>
    
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-3 py-2 fw-semibold" style="border-radius: 0.75rem;">
        <i class="fa-solid fa-user-shield me-1"></i> Tambah Admin Baru
    </a>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Nomor HP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $index => $admin)
                    <tr>
                        <td class="fw-semibold">{{ $index + 1 }}</td>
                        <td class="fw-semibold text-dark">{{ $admin->name }}</td>
                        <td>{{ $admin->username ?? '-' }}</td>
                        <td>{{ $admin->no_hp ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.users.edit', $admin->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 0.5rem;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if(Auth::id() !== $admin->id)
                                <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 0.5rem;" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data admin lain.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection