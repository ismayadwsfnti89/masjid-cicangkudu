@extends('admin.layout')

@section('title', 'Catat Transaksi')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="fa-solid fa-file-invoice-dollar me-2"></i>
                Catat Transaksi
            </h3>
            <p class="text-muted mb-0">
                Riwayat pemasukan kas dan donasi, pengeluaran, serta saldo Masjid Jami Cicangkudu.
            </p>
        </div>
        <a href="{{ route('admin.kas-kk.index') }}" class="btn btn-outline-success"><i class="fa-solid fa-wallet me-1"></i> Kelola Kas KK</a>
    </div>

    {{-- FORM TAMBAH --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-plus me-2"></i>
                Catat Transaksi
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.contents.store', 'laporan-keuangan') }}"
                  method="POST">

                @csrf

                <div class="row g-3">

                    {{-- Judul --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Judul
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Contoh: Belanja perlengkapan kebersihan"
                               required>
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Tanggal
                        </label>

                        <input type="date"
                               name="event_date"
                               class="form-control"
                               required>
                    </div>

                    {{-- Jumlah --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Jumlah
                        </label>

                        <input type="number"
                               name="amount"
                               class="form-control"
                               min="0"
                               placeholder="Contoh: 500000"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Jenis Catatan
                        </label>
                        <select name="transaction_type" class="form-select" required>
                            <option value="pengeluaran">Pengeluaran</option>
                            <option value="pemasukan">Pemasukan lainnya</option>
                        </select>
                        <div class="form-text">Pemasukan kas KK dan donasi tercatat otomatis setelah diverifikasi. Gunakan pemasukan lainnya hanya untuk sumber selain keduanya.</div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Keterangan
                        </label>

                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Masukkan keterangan transaksi"></textarea>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="published">Dipublikasikan</option>
                            <option value="draft">Draft</option>

                        </select>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit"
                            class="btn btn-success px-4">

                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Simpan Laporan

                    </button>
                </div>

            </form>

        </div>
    </div>


    {{-- RINGKASAN --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Pemasukan</p>
                    <h4 class="fw-bold text-success">
                        Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Pengeluaran</p>
                    <h4 class="fw-bold text-danger">
                        Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Saldo</p>
                    <h4 class="fw-bold">
                        Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

    </div>


    {{-- TABEL LAPORAN --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-list me-2"></i>
                Data Laporan Keuangan
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($contents as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->event_date?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td>
                                    <strong>{{ $item->title }}</strong>

                                    @if($item->description)
                                        <br>
                                        <small class="text-muted">
                                            {{ $item->description }}
                                        </small>
                                    @endif
                                </td>

                                <td>

                                    @if($item->is_kas_kk ?? false)

                                        <span class="badge bg-success">Kas KK Masuk</span>

                                    @elseif($item->transaction_type === 'pemasukan')

                                        <span class="badge bg-success">
                                            {{ $item->donation_id ? 'Donasi Masuk' : 'Pemasukan Lainnya' }}
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Pengeluaran
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    Rp {{ number_format($item->amount, 0, ',', '.') }}
                                </td>

                                <td>

                                    @if($item->status === 'published')

                                        <span class="badge bg-success">
                                            Published
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($item->status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($item->is_kas_kk ?? false)
                                        <span class="text-muted small">Otomatis dari Kas KK</span>
                                    @else

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('admin.contents.edit', ['section' => 'laporan-keuangan', 'content' => $item->id]) }}"
                                           class="btn btn-warning btn-sm">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <form action="{{ route('admin.contents.destroy', ['section' => 'laporan-keuangan', 'content' => $item->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center text-muted py-4">

                                    Belum ada data laporan keuangan.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
