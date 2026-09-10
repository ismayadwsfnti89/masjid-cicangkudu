@extends('admin.layout')

@section('title', 'Import Data Warga | Admin Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Import Data Warga</h2>
        <p class="text-muted mb-0">Unggah file Excel atau CSV untuk memasukkan warga sekaligus membuat dan menghubungkan data KK.</p>
    </div>
</div>


@if($errors->any())
    <div class="alert alert-danger d-flex align-items-center mb-4" role="alert" style="border-radius: 0.75rem;">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        <div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <form action="{{ route('admin.import-warga.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file" class="form-label fw-semibold text-secondary">Pilih File (Excel / CSV)</label>
                <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls,.csv" required style="border-radius: 0.5rem; padding: 0.75rem;">
                <div class="form-text mt-2">
                    Kolom wajib: <code>nama</code>, <code>nik</code>, <code>no_kk</code>, dan <code>golongan</code> (isi 1, 2, atau 3).
                    Kolom opsional: <code>username</code>, <code>email</code>, <code>no_hp</code>, dan <code>alamat</code>.
                    Baris dengan No. KK yang sama otomatis menjadi anggota KK yang sama. Username dan email dibuat otomatis bila dikosongkan.
                </div>
            </div>

            <div class="alert alert-light border small mb-0">
                <strong>Format header Excel:</strong><br>
                <code>nama | nik | no_kk | golongan | username | email | no_hp | alamat</code><br>
                Contoh: Ahmad | 3201... | KK001 | 2 | ahmad | ahmad@email.com | 08... | Cicangkudu
            </div>

            <button type="submit" class="btn btn-success px-4 py-2" style="border-radius: 0.5rem;">
                <i class="fa-solid fa-file-arrow-up me-2"></i> Import Data
            </button>
        </form>
    </div>
</div>
@endsection
