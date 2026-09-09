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
                        <tr class="{{ $isToday ? 'table-success' : '' }}">
                            <td class="fw-semibold text-dark">{{ $jadwal['tanggal'] ?? '-' }}</td>
                            <td><span class="{{ $isToday ? 'badge bg-success' : 'text-muted' }}">{{ isset($jadwal['date']) ? \Carbon\Carbon::parse($jadwal['date'])->translatedFormat('l') : '-' }}{{ $isToday ? ' · Hari ini' : '' }}</span></td>
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
