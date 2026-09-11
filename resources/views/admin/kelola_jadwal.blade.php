@extends('admin.layout')

@section('title', 'Kelola Jadwal | Admin Masjid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
        <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">Jadwal Salat (Otomatis API)</h2>
        <p class="text-muted mb-0">Jadwal untuk Cicangkudu, Mangunreja, Kabupaten Tasikmalaya, disinkronkan dari data Kemenag.</p>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-body p-4">
        <form method="GET" action="{{ route('admin.jadwal') }}" class="row g-3 align-items-end mb-4">
            <div class="col-sm-5 col-md-4">
                <label for="bulan" class="form-label fw-semibold">Bulan</label>
                <select id="bulan" name="bulan" class="form-select">
                    @foreach($bulanOptions as $nomorBulan => $namaBulan)
                        <option value="{{ $nomorBulan }}" @selected($bulan === $nomorBulan)>{{ $namaBulan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5 col-md-3">
                <label for="tahun" class="form-label fw-semibold">Tahun</label>
                <select id="tahun" name="tahun" class="form-select">
                    @foreach($tahunOptions as $opsiTahun)
                        <option value="{{ $opsiTahun }}" @selected($tahun === $opsiTahun)>{{ $opsiTahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 col-md-auto">
                <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-calendar-check me-1"></i>Tampilkan</button>
            </div>
        </form>
        <p class="text-muted small mb-3">Pilih bulan dan tahun untuk melihat jadwal terdahulu atau jadwal tahun berikutnya yang tersedia di API.</p>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Imsak</th>
                        <th>Subuh</th>
                        <th>Terbit</th>
                        <th>Dzuhur</th>
                        <th>Ashar</th>
                        <th>Maghrib</th>
                        <th>Isya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalList ?? [] as $jadwal)
                        @php($isToday = ($jadwal['date'] ?? null) === now('Asia/Jakarta')->toDateString())
                        @php($tanggal = isset($jadwal['date']) ? \Carbon\Carbon::parse($jadwal['date'])->locale('id') : null)
                        <tr class="{{ $isToday ? 'table-success' : '' }}">
                            <td class="fw-semibold text-dark">{{ $tanggal?->translatedFormat('d F Y') ?? '-' }}</td>
                            <td><span class="{{ $isToday ? 'badge bg-success' : 'text-muted' }}">{{ $tanggal?->translatedFormat('l') ?? '-' }}{{ $isToday ? ' · Hari ini' : '' }}</span></td>
                            <td>{{ $jadwal['imsak'] ?? '-' }}</td>
                            <td class="fw-semibold text-primary">{{ $jadwal['subuh'] ?? '-' }}</td>
                            <td>{{ $jadwal['terbit'] ?? '-' }}</td>
                            <td>{{ $jadwal['dzuhur'] ?? '-' }}</td>
                            <td>{{ $jadwal['ashar'] ?? '-' }}</td>
                            <td class="fw-semibold text-success">{{ $jadwal['maghrib'] ?? '-' }}</td>
                            <td>{{ $jadwal['isya'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">Gagal memuat data dari API.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
