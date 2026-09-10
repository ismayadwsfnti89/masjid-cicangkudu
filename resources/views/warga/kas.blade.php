@extends('warga.layout')

@section('title', 'Kas Keluarga | Masjid Jami Cicangkudu')
@section('header', 'Kas Keluarga')

@section('content')
@php
    $labels = [
        'pending' => ['Menunggu Verifikasi', 'warning'],
        'verified' => ['Sudah Bayar', 'success'],
        'rejected' => ['Bukti Ditolak', 'danger'],
        'belum_bayar' => ['Belum Bayar', 'secondary'],
    ];
@endphp

<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke Dashboard</a>
    <h2 class="fw-bold mt-2 mb-1" style="font-family:serif">Kas Keluarga</h2>
    <p class="text-muted mb-0">Kas berlaku untuk satu KK dan setiap pembayaran diperiksa pengurus.</p>
</div>

@if (! $family)
    <div class="alert alert-warning">Data KK belum tersedia. Hubungi pengurus agar akun Anda dihubungkan ke KK.</div>
@else
    @php($currentStatus = $paymentPeriode?->status ?? 'belum_bayar')
    <div class="row g-4 mb-4">
        <div class="col-lg-7"><div class="card border-0 shadow-sm h-100" style="border-radius:1rem"><div class="card-body p-4">
            <h5 class="fw-bold">Identitas Kas Keluarga</h5>
            <dl class="row mb-0">
                <dt class="col-sm-5 text-muted">Nama akun</dt><dd class="col-sm-7">{{ $profile->user?->name ?? '-' }}</dd>
                <dt class="col-sm-5 text-muted">NIK</dt><dd class="col-sm-7">{{ $profile->nik ?? '-' }}</dd>
                <dt class="col-sm-5 text-muted">No. KK</dt><dd class="col-sm-7 fw-semibold">{{ $family->no_kk }}</dd>
                <dt class="col-sm-5 text-muted">Golongan</dt><dd class="col-sm-7">Golongan {{ $family->golongan }}</dd>
                <dt class="col-sm-5 text-muted">Kas wajib</dt><dd class="col-sm-7 fw-semibold text-success">Rp {{ number_format($family->nominal_kas, 0, ',', '.') }} / bulan</dd>
            </dl>
        </div></div></div>
        <div class="col-lg-5"><div class="card border-0 shadow-sm h-100" style="border-radius:1rem"><div class="card-body p-4">
            <h5 class="fw-bold">Kas {{ \Carbon\Carbon::create(null, $bulan, 1)->translatedFormat('F') }} {{ $tahun }}</h5>
            <p>Status: <span class="badge bg-{{ $labels[$currentStatus][1] }}">{{ $labels[$currentStatus][0] }}</span></p>

            @if ($currentStatus === 'verified')
                <p class="text-muted small mb-0">Sudah diverifikasi pengurus{{ $paymentPeriode->payer ? ' · dibayar oleh '.$paymentPeriode->payer->name : '' }}.</p>
            @elseif ($currentStatus === 'pending')
                <p class="text-muted small mb-0">Pengajuan dari {{ $paymentPeriode->payer?->name ?? 'anggota KK' }} sedang menunggu verifikasi. Anggota KK lain tidak perlu membayar lagi.</p>
            @else
                @if ($currentStatus === 'rejected')
                    <div class="alert alert-danger small py-2">Pengajuan sebelumnya ditolak. Silakan ajukan ulang.</div>
                @endif
                <form method="POST" action="{{ route('kas.saya.bayar') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <label class="form-label small fw-semibold">Metode pembayaran</label>
                    <select id="paymentMethod" name="payment_method" class="form-select" required>
                        <option value="cash">Bayar langsung / tunai ke pengurus</option>
                        <option value="transfer_bank">Transfer bank</option>
                        <option value="qris">QRIS</option>
                    </select>
                    <div id="proofGroup" class="mt-3 d-none">
                        <label class="form-label small fw-semibold">Bukti transfer (JPG, PNG, atau PDF)</label>
                        <input type="file" name="proof" accept="image/jpeg,image/png,application/pdf" class="form-control @error('proof') is-invalid @enderror">
                        @error('proof')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-success w-100 mt-3">Ajukan Pembayaran Rp {{ number_format($family->nominal_kas, 0, ',', '.') }}</button>
                </form>
            @endif
        </div></div></div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius:1rem"><div class="card-body p-4">
        <h5 class="fw-bold mb-3">Riwayat Kas KK {{ $family->no_kk }}</h5>
        <div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Periode</th><th>Nominal</th><th>Metode</th><th>Pembayar</th><th>Status</th></tr></thead><tbody>
            @forelse ($payments as $payment)
                <tr><td>{{ \Carbon\Carbon::create(null, $payment->bulan, 1)->translatedFormat('F') }} {{ $payment->tahun }}</td><td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td><td>{{ ['cash' => 'Tunai', 'transfer_bank' => 'Transfer bank', 'qris' => 'QRIS'][$payment->payment_method] ?? '-' }}</td><td>{{ $payment->payer?->name ?? '-' }}</td><td><span class="badge bg-{{ $labels[$payment->status][1] }}">{{ $labels[$payment->status][0] }}</span></td></tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada riwayat kas untuk KK ini.</td></tr>
            @endforelse
        </tbody></table></div>
    </div></div>
@endif
@endsection

@push('scripts')
<script>
const method = document.getElementById('paymentMethod');
const proof = document.getElementById('proofGroup');
function updateProof() { if (method && proof) proof.classList.toggle('d-none', method.value === 'cash'); }
method?.addEventListener('change', updateProof);
updateProof();
</script>
@endpush
