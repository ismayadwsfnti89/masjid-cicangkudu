@extends('admin.layout')

@section('title', 'Kelola '.$meta['label'].' | Admin Masjid')
@section('header', 'Kelola '.$meta['label'])

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Kelola {{ $meta['label'] }}</h2>
        <p class="text-muted mb-0">Tambah, ubah, terbitkan, atau hapus data {{ strtolower($meta['label']) }}.</p>
    </div>
    <a href="{{ route('admin.contents.create', $section) }}" class="btn btn-success px-3 py-2 fw-semibold" style="border-radius: .75rem;">
        <i class="fa-solid fa-plus me-1"></i> Tambah Data
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        @if($meta['requires_amount'])<th>Nominal</th>@endif
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contents as $content)
                    <tr>
                        <td class="d-flex align-items-center gap-2">@if($content->image_path)<img src="{{ asset('storage/'.$content->image_path) }}" style="width:48px;height:48px;object-fit:cover" class="rounded" alt="">@endif<div><strong class="text-dark">{{ $content->title }}</strong><br><small class="text-muted">{{ \Illuminate\Support\Str::limit($content->description, 70) }}</small></div></td>
                        <td>{{ $content->event_date?->translatedFormat('d M Y') ?? '-' }}</td>
                        @if($meta['requires_amount'])<td>Rp {{ number_format((float) $content->amount, 0, ',', '.') }}</td>@endif
                        <td><span class="status-pill status-{{ $content->status }} text-capitalize">{{ $content->status }}</span></td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('admin.contents.edit', [$section, $content]) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.contents.destroy', [$section, $content]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="{{ $meta['requires_amount'] ? 5 : 4 }}" class="text-center text-muted py-4">Belum ada data {{ strtolower($meta['label']) }}.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@if($section === 'donasi')
<div class="card border-0 shadow-sm mt-4" style="border-radius: 1rem;"><div class="card-body p-4"><h5 class="fw-bold mb-1">Pengaturan QRIS & Rekening</h5><p class="text-muted small">Data ini langsung tampil pada halaman donasi warga.</p><form method="POST" enctype="multipart/form-data" action="{{ route('admin.payment-settings.update') }}">@csrf<div class="row g-3"><div class="col-md-4"><label class="form-label">Nama bank</label><input name="bank_name" class="form-control" value="{{ old('bank_name', $paymentSetting?->bank_name) }}" required></div><div class="col-md-4"><label class="form-label">Nomor rekening</label><input name="account_number" class="form-control" value="{{ old('account_number', $paymentSetting?->account_number) }}" required></div><div class="col-md-4"><label class="form-label">Nama pemilik rekening</label><input name="account_name" class="form-control" value="{{ old('account_name', $paymentSetting?->account_name) }}" required></div><div class="col-md-6"><label class="form-label">Gambar QRIS</label><input type="file" name="qris" accept="image/jpeg,image/png" class="form-control">@if($paymentSetting?->qris_path)<small class="text-success">QRIS sudah tersimpan.</small>@endif</div></div><button class="btn btn-success mt-3">Simpan Pengaturan Pembayaran</button></form></div></div>
<div class="card border-0 shadow-sm mt-4" style="border-radius: 1rem;"><div class="card-body p-4"><h5 class="fw-bold mb-3">Bukti Donasi Masuk</h5><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Warga</th><th>Program</th><th>Nominal</th><th>Metode</th><th>Bukti</th><th>Status</th></tr></thead><tbody>@forelse($donations as $donation)<tr><td>{{ $donation->user->name }}</td><td>{{ $donation->program?->title ?? 'Donasi umum' }}</td><td>Rp {{ number_format((float)$donation->amount,0,',','.') }}</td><td class="text-uppercase">{{ $donation->payment_method }}</td><td><a target="_blank" class="btn btn-sm btn-outline-primary" href="{{ asset('storage/'.$donation->proof_path) }}">Lihat bukti</a></td><td><span class="badge bg-warning text-dark text-capitalize">{{ $donation->status }}</span></td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-3">Belum ada bukti donasi yang dikirim.</td></tr>@endforelse</tbody></table></div></div></div>
@endif
@endsection
