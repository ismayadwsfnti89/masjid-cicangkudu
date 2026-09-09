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
                Transparansi pemasukan dan pengeluaran Masjid Jami Cicangkudu.
            </p>
        </div>

        <span class="text-muted small d-none d-md-inline">
            Sistem Digital Masjid
        </span>

    </div>
</div>


{{-- NERACA KAS --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:1rem;">
    <div class="card-body p-4 p-md-5">
        <div class="d-flex justify-content-between align-items-start mb-3"><div><h5 class="fw-bold mb-1">Neraca Kas Masjid</h5><p class="text-muted small mb-0">Posisi kas berdasarkan transaksi pemasukan dan pengeluaran yang telah dipublikasikan.</p></div><span class="badge bg-success">Basis Kas</span></div>
        <div class="row g-3"><div class="col-md-6"><div class="border rounded-3 p-3 h-100"><strong class="d-block mb-2 text-success">Aset</strong><div class="d-flex justify-content-between"><span>Kas dan Bank</span><strong>Rp {{ number_format($neraca['aset_kas'], 0, ',', '.') }}</strong></div><hr><div class="d-flex justify-content-between"><strong>Total Aset</strong><strong>Rp {{ number_format($neraca['aset_kas'], 0, ',', '.') }}</strong></div></div></div><div class="col-md-6"><div class="border rounded-3 p-3 h-100"><strong class="d-block mb-2 text-primary">Kewajiban dan Dana Bersih</strong><div class="d-flex justify-content-between"><span>Kewajiban</span><strong>Rp {{ number_format($neraca['kewajiban'], 0, ',', '.') }}</strong></div><div class="d-flex justify-content-between mt-2"><span>Dana Bersih</span><strong>Rp {{ number_format($neraca['dana_bersih'], 0, ',', '.') }}</strong></div><hr><div class="d-flex justify-content-between"><strong>Total</strong><strong>Rp {{ number_format($neraca['kewajiban'] + $neraca['dana_bersih'], 0, ',', '.') }}</strong></div></div></div></div>
    </div>
</div>

{{-- ========================= --}}
{{-- RINGKASAN KEUANGAN --}}
{{-- ========================= --}}

<div class="row g-4 mb-4">

    {{-- PEMASUKAN --}}
    <div class="col-md-6 col-lg-4">

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
    <div class="col-md-6 col-lg-4">

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
    <div class="col-md-6 col-lg-4">

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
                    Daftar pemasukan dan pengeluaran Masjid Jami Cicangkudu.
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
                                        Pemasukan
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
