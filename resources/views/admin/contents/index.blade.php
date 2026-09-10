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
                        <th><input id="selectAllContents" type="checkbox" class="form-check-input" title="Pilih semua"></th>
                        <th>Judul</th>
                        @if($section === 'informasi-masjid')<th>Jenis</th>@endif
                        <th>Tanggal</th>
                        @if($meta['requires_amount'])<th>{{ $section === 'donasi' ? 'Target' : 'Nominal' }}</th>@endif
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contents as $content)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $content->id }}" form="bulkDeleteContents" class="form-check-input content-checkbox"></td>
                        <td class="d-flex align-items-center gap-2">@if($content->image_path)<img src="{{ asset('storage/'.$content->image_path) }}" style="width:48px;height:48px;object-fit:cover" class="rounded" alt="">@endif<div><strong class="text-dark">{{ $content->title }}</strong><br><small class="text-muted">{{ \Illuminate\Support\Str::limit($content->description, 70) }}</small></div></td>
                        @if($section === 'informasi-masjid')<td><span class="badge bg-success">{{ $content->type === 'kegiatan' ? 'Kegiatan' : 'Informasi' }}</span></td>@endif
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
                    <tr><td colspan="{{ $meta['requires_amount'] ? 6 : ($section === 'informasi-masjid' ? 6 : 5) }}" class="text-center text-muted py-4">Belum ada data {{ strtolower($meta['label']) }}.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<form id="bulkDeleteContents" action="{{ route('admin.contents.bulk-destroy', $section) }}" method="POST" class="mt-3" onsubmit="return confirm('Hapus semua data yang dipilih? Tindakan ini tidak dapat dibatalkan.');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="fa-solid fa-trash me-1"></i> Hapus data terpilih
    </button>
    <span class="text-muted small ms-2">Pilih data dari tabel terlebih dahulu.</span>
</form>
@push('scripts')
<script>
document.getElementById('selectAllContents')?.addEventListener('change', function () {
    document.querySelectorAll('.content-checkbox').forEach(item => item.checked = this.checked);
});
</script>
@endpush
@if($section === 'informasi-masjid')
<div class="card border-0 shadow-sm mt-4" style="border-radius:1rem"><div class="card-body p-4"><div class="d-flex justify-content-between align-items-start mb-3"><div><h5 class="fw-bold mb-1">Profil Masjid yang Tampil di Warga</h5><p class="text-muted small mb-0">Ubah foto, biodata, visi, dan misi pada kartu profil halaman Informasi Masjid warga.</p></div></div><form method="POST" enctype="multipart/form-data" action="{{ route('admin.masjid-profile.update') }}">@csrf @method('PUT')<div class="row g-3"><div class="col-md-6"><label class="form-label">Nama masjid</label><input name="name" class="form-control" value="{{ old('name', $masjidProfile?->name ?? 'Masjid Jami Cicangkudu') }}" required></div><div class="col-md-6"><label class="form-label">Jenis masjid</label><input name="masjid_type" class="form-control" value="{{ old('masjid_type', $masjidProfile?->masjid_type ?? 'Masjid Jami') }}" required></div><div class="col-12"><label class="form-label">Deskripsi singkat</label><textarea name="description" rows="3" class="form-control" required>{{ old('description', $masjidProfile?->description ?? "Pusat ibadah, pendidikan Al-Qur'an, serta kegiatan sosial warga Cicangkudu.") }}</textarea></div><div class="col-md-6"><label class="form-label">Alamat</label><input name="address" class="form-control" value="{{ old('address', $masjidProfile?->address ?? 'Cicangkudu, Mangunreja, Kab. Tasikmalaya') }}" required></div><div class="col-md-6"><label class="form-label">Jam buka</label><input name="open_hours" class="form-control" value="{{ old('open_hours', $masjidProfile?->open_hours ?? 'Terbuka setiap hari') }}" required></div><div class="col-md-6"><label class="form-label">Keterangan kegiatan</label><input name="activity_label" class="form-control" value="{{ old('activity_label', $masjidProfile?->activity_label ?? 'Pusat kegiatan warga') }}" required></div><div class="col-md-6"><label class="form-label">Foto profil masjid</label><input id="profileImage" type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control">@if($masjidProfile?->image_path)<img id="profilePreview" src="{{ asset('storage/'.$masjidProfile->image_path) }}" class="img-thumbnail mt-2" style="height:80px;object-fit:cover" alt="Foto profil masjid">@else<img id="profilePreview" class="img-thumbnail mt-2 d-none" style="height:80px;object-fit:cover" alt="Preview foto profil masjid">@endif</div><div class="col-md-6"><label class="form-label">Visi</label><textarea name="vision" rows="4" class="form-control" required>{{ old('vision', $masjidProfile?->vision ?? 'Mewujudkan masjid sebagai pusat ibadah, pendidikan, dan kegiatan sosial yang bermanfaat bagi masyarakat.') }}</textarea></div><div class="col-md-6"><label class="form-label">Misi</label><textarea name="mission" rows="4" class="form-control" required>{{ old('mission', $masjidProfile?->mission ?? 'Melayani jamaah dengan terbuka, menguatkan kegiatan keagamaan, dan menjaga transparansi program masjid.') }}</textarea></div></div><button class="btn btn-success mt-3"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan Profil Masjid</button></form></div></div>
@push('scripts')<script>document.getElementById('profileImage')?.addEventListener('change',function(){const file=this.files?.[0];if(!file)return;const preview=document.getElementById('profilePreview');preview.src=URL.createObjectURL(file);preview.classList.remove('d-none');});</script>@endpush
@endif
@if($section === 'donasi')
<div class="card border-0 shadow-sm mt-4" style="border-radius: 1rem;"><div class="card-body p-4"><h5 class="fw-bold mb-1">Pengaturan QRIS & Rekening</h5><p class="text-muted small">Data ini langsung tampil pada halaman donasi warga.</p><form method="POST" enctype="multipart/form-data" action="{{ route('admin.payment-settings.update') }}">@csrf<div class="row g-3"><div class="col-md-4"><label class="form-label">Nama bank</label><input name="bank_name" class="form-control" value="{{ old('bank_name', $paymentSetting?->bank_name) }}" required></div><div class="col-md-4"><label class="form-label">Nomor rekening</label><input name="account_number" class="form-control" value="{{ old('account_number', $paymentSetting?->account_number) }}" required></div><div class="col-md-4"><label class="form-label">Nama pemilik rekening</label><input name="account_name" class="form-control" value="{{ old('account_name', $paymentSetting?->account_name) }}" required></div><div class="col-md-6"><label class="form-label">Gambar QRIS</label><input type="file" name="qris" accept="image/jpeg,image/png" class="form-control">@if($paymentSetting?->qris_path)<small class="text-success">QRIS sudah tersimpan.</small>@endif</div></div><button class="btn btn-success mt-3">Simpan Pengaturan Pembayaran</button></form></div></div>
<div class="card border-0 shadow-sm mt-4" style="border-radius: 1rem;"><div class="card-body p-4"><h5 class="fw-bold mb-3">Bukti Donasi Masuk</h5><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Warga</th><th>Program</th><th>Nominal</th><th>Metode</th><th>Bukti</th><th>Status</th><th class="text-center">Verifikasi</th></tr></thead><tbody>@forelse($donations as $donation)<tr><td>{{ $donation->user->name }}</td><td>{{ $donation->program?->title ?? 'Donasi umum' }}</td><td>Rp {{ number_format((float)$donation->amount,0,',','.') }}</td><td class="text-uppercase">{{ $donation->payment_method }}</td><td><a target="_blank" class="btn btn-sm btn-outline-primary" href="{{ asset('storage/'.$donation->proof_path) }}">Lihat bukti</a></td><td><span class="status-pill status-{{ $donation->status }} text-capitalize">{{ $donation->status }}</span></td><td class="text-center">@if($donation->status === 'pending')<form action="{{ route('admin.donations.verify', $donation) }}" method="POST" class="d-inline">@csrf @method('PUT')<button class="btn btn-sm btn-success" onclick="return confirm('Verifikasi donasi ini?')">Terima</button></form><form action="{{ route('admin.donations.reject', $donation) }}" method="POST" class="d-inline">@csrf @method('PUT')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Tolak bukti donasi ini?')">Tolak</button></form>@else<span class="text-muted small">Sudah diproses</span>@endif</td></tr>@empty<tr><td colspan="7" class="text-center text-muted py-3">Belum ada bukti donasi yang dikirim.</td></tr>@endforelse</tbody></table></div></div></div>
@endif
@endsection
