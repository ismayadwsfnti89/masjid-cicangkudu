@extends('warga.layout')

@section('title', 'Laporan Keuangan | Masjid Jami Cicangkudu')

@section('content')

<div class="mb-4">

    <a href="{{ route('dashboard') }}"
       class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
        <i class="fa-solid fa-arrow-left me-1"></i>
        Kembali ke Dashboard
    </a>

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h2 class="fw-bold mb-1"
                style="color: #111d13; font-family: serif;">
                Laporan Keuangan
            </h2>

            <p class="text-muted mb-0">
                Transparansi pemasukan kas dan donasi, pengeluaran, serta saldo Masjid Jami Cicangkudu.
            </p>
        </div>

        <span class="text-muted small d-none d-md-inline">
            Sistem Digital Masjid
        </span>

    </div>
</div>


{{-- ========================= --}}
{{-- RINGKASAN KEUANGAN --}}
{{-- ========================= --}}

<div class="row g-4 mb-4">

    {{-- PEMASUKAN --}}
    <div class="col-md-6 col-lg-3">

        <div class="card border-0 shadow-sm h-100"
             style="border-radius: 1rem;">

            <div class="card-body p-4 d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:52px;height:52px;background:#e8f5e9;color:#0b5c3d;">

                    <i class="fa-solid fa-arrow-down fs-4"></i>

                </div>

                <div>

                    <span class="text-muted small d-block mb-1">
                        Total Pemasukan
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color:#0b5c3d;">

                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>


    {{-- PENGELUARAN --}}
    <div class="col-md-6 col-lg-3">

        <div class="card border-0 shadow-sm h-100"
             style="border-radius:1rem;">

            <div class="card-body p-4 d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:52px;height:52px;background:#fbe9e7;color:#d32f2f;">

                    <i class="fa-solid fa-arrow-up fs-4"></i>

                </div>

                <div>

                    <span class="text-muted small d-block mb-1">
                        Total Pengeluaran
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color:#d32f2f;">

                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>


    {{-- SALDO --}}
    <div class="col-md-6 col-lg-3">

        <div class="card border-0 shadow-sm h-100"
             style="border-radius:1rem;">

            <div class="card-body p-4 d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:52px;height:52px;background:#e3f2fd;color:#1976d2;">

                    <i class="fa-solid fa-wallet fs-4"></i>

                </div>

                <div>

                    <span class="text-muted small d-block mb-1">
                        Saldo
                    </span>

                    <h4 class="fw-bold mb-0"
                        style="color:#1976d2;">

                        Rp {{ number_format($saldo, 0, ',', '.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:52px;height:52px;background:#fff4d6;color:#9a6700;"><i class="fa-solid fa-people-roof fs-4"></i></div>
                <div><span class="text-muted small d-block mb-1">Pemasukan Kas KK</span><h4 class="fw-bold mb-0" style="color:#9a6700;">Rp {{ number_format($pemasukanKas, 0, ',', '.') }}</h4></div>
            </div>
        </div>
    </div>
</div>

{{-- KETENTUAN KAS DAN NERACA --}}
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:38px;height:38px;background:#fff4d6;color:#9a6700;"><i class="fa-solid fa-people-roof"></i></span>
                    <div><h5 class="fw-bold mb-0">Ketentuan Kas Warga</h5><small class="text-muted">Jumlah warga terdaftar: 100 KK</small></div>
                </div>
                <div class="table-responsive"><table class="table table-sm align-middle mb-0"><thead class="text-muted small"><tr><th>Golongan</th><th class="text-end">Iuran / bulan</th></tr></thead><tbody><tr><td>Golongan 1</td><td class="text-end fw-semibold">Rp 3.000</td></tr><tr><td>Golongan 2</td><td class="text-end fw-semibold">Rp 5.000</td></tr><tr><td>Golongan 3</td><td class="text-end fw-semibold">Rp 10.000</td></tr></tbody></table></div>
                <p class="small text-muted mb-0 mt-3">Kas dihimpun setiap bulan. Token listrik dicatat sebagai pengeluaran rutin bulanan.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius:1rem;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-scale-balanced text-primary me-2"></i>Neraca {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}</h5>
                <div class="d-flex justify-content-between border-bottom py-2"><span class="text-muted">Pemasukan</span><strong class="text-success">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between border-bottom py-2"><span class="text-muted">Pengeluaran</span><strong class="text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between pt-3"><strong>Saldo akhir</strong><strong class="text-primary fs-5">Rp {{ number_format($saldo, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>
</div>

{{-- REKAP PEMBAYARAN KAS --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:1rem;">
    <div class="card-body p-4 p-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div><h5 class="fw-bold mb-1" style="color:#111d13;">Rekap Pembayaran Kas</h5><p class="text-muted small mb-0">Hanya pembayaran yang sudah diverifikasi dihitung sebagai pemasukan.</p></div>
            <div class="d-flex gap-2"><span class="badge bg-success bg-opacity-15 text-success px-3 py-2">{{ $jumlahSudahBayar }} KK sudah bayar</span><span class="badge bg-secondary bg-opacity-15 text-secondary px-3 py-2">{{ $jumlahBelumBayar }} KK belum bayar</span></div>
        </div>
        <div class="row g-3 mb-4"><div class="col-md-4"><div class="border rounded-3 p-3"><small class="text-muted d-block">Pemasukan kas</small><strong class="text-success fs-5">Rp {{ number_format($pemasukanKas, 0, ',', '.') }}</strong></div></div><div class="col-md-4"><div class="border rounded-3 p-3"><small class="text-muted d-block">Sudah bayar</small><strong>{{ $jumlahSudahBayar }} dari 100 KK</strong></div></div><div class="col-md-4"><div class="border rounded-3 p-3"><small class="text-muted d-block">Belum bayar</small><strong>{{ $jumlahBelumBayar }} dari 100 KK</strong></div></div></div>
        <div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>No. KK</th><th>Golongan</th><th>Nominal</th><th>Pembayar</th><th>Tanggal bayar</th><th>Status</th></tr></thead><tbody>@forelse($kasPayments as $payment)<tr><td class="fw-semibold">{{ $payment->family->no_kk }}</td><td>{{ $payment->nama_golongan }}</td><td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td><td>{{ $payment->payer?->name ?? '-' }}</td><td>{{ $payment->tanggal_pembayaran?->translatedFormat('d M Y') ?? '-' }}</td><td>@if($payment->status === 'verified')<span class="badge bg-success">Sudah Diverifikasi</span>@elseif($payment->status === 'pending')<span class="badge bg-warning text-dark">Menunggu Verifikasi</span>@else<span class="badge bg-danger">Bukti Ditolak</span>@endif</td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">Belum ada pembayaran kas pada periode ini.</td></tr>@endforelse</tbody></table></div>
    </div>
</div>


{{-- ========================= --}}
{{-- RIWAYAT TRANSAKSI --}}
{{-- ========================= --}}

<div class="card border-0 shadow-sm mb-4"
     style="border-radius:1rem;">

    <div class="card-body p-4 p-md-5">

        <div class="d-flex flex-column flex-md-row
                    justify-content-between align-items-md-center
                    mb-4 gap-3">

            <div>

                <h5 class="fw-bold mb-1"
                    style="color:#111d13;">
                    Riwayat Transaksi
                </h5>

                <p class="text-muted mb-0 small">
                    Daftar pemasukan kas, donasi, dan pengeluaran Masjid Jami Cicangkudu.
                </p>

            </div>


            {{-- FILTER BULAN --}}
            <form method="GET"
                  action="{{ route('laporan') }}"
                  style="width:200px;">

                <select name="bulan"
                        class="form-select form-select-sm border-light bg-light py-2"
                        onchange="this.form.submit()">

                    @foreach($bulanOptions as $option)

                        <option value="{{ $option['value'] }}"
                            {{ $bulan == $option['value'] ? 'selected' : '' }}>

                            {{ $option['label'] }}

                        </option>

                    @endforeach

                </select>

            </form>

        </div>


        <div class="table-responsive">

            <table class="table align-middle table-hover mb-0">

                <thead class="table-light text-uppercase text-muted"
                       style="font-size:.75rem;letter-spacing:.5px;">

                    <tr>

                        <th class="py-3 ps-3">
                            Tanggal
                        </th>

                        <th class="py-3">
                            Keterangan
                        </th>

                        <th class="py-3">
                            Jenis
                        </th>

                        <th class="py-3 pe-3 text-end">
                            Nominal
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($transaksi as $item)

                        <tr>

                            {{-- TANGGAL --}}
                            <td class="ps-3 text-muted small">

                                {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}

                            </td>


                            {{-- KETERANGAN --}}
                            <td class="fw-semibold text-dark">

                                {{ $item->title }}

                            </td>


                            {{-- JENIS --}}
                            <td>

                                @if($item->transaction_type === 'pemasukan')

                                    <span class="badge bg-success bg-opacity-15 text-success px-2 py-1">
                                        {{ $item->is_kas_kk ? 'Pemasukan Kas KK' : ($item->donation_id ? 'Donasi Masuk' : 'Pemasukan Lain') }}
                                    </span>

                                @else

                                    <span class="badge bg-danger bg-opacity-15 text-danger px-2 py-1">
                                        Pengeluaran
                                    </span>

                                @endif

                            </td>


                            {{-- NOMINAL --}}
                            <td class="pe-3 text-end fw-bold
                                {{ $item->transaction_type === 'pemasukan'
                                    ? 'text-success'
                                    : 'text-danger' }}">

                                {{ $item->transaction_type === 'pemasukan' ? '+' : '-' }}

                                Rp {{ number_format($item->amount, 0, ',', '.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-5 text-muted">

                                <i class="fa-solid fa-receipt fs-2 mb-3 d-block"></i>

                                Belum ada transaksi pada bulan ini.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- TRANSPARANSI --}}
{{-- ========================= --}}

<div class="card border-0 shadow-sm"
     style="border-radius:1rem;background:#e8f5e9;">

    <div class="card-body p-4 d-flex align-items-start">

        <div class="me-3 text-success fs-4 mt-1">

            <i class="fa-solid fa-shield-halved"></i>

        </div>

        <div>

            <strong class="fw-bold d-block mb-1"
                    style="color:#0b5c3d;">

                Transparansi Keuangan

            </strong>

            <p class="text-muted mb-0 small">

                Laporan keuangan ditampilkan sebagai bentuk
                transparansi kepada warga dan jamaah
                Masjid Jami Cicangkudu.

            </p>

        </div>

    </div>

</div>

@endsection
