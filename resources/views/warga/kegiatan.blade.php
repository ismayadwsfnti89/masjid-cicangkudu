@extends('warga.layout')

@section('title', 'Kegiatan | Masjid Jami Cicangkudu')
@section('header', 'Kegiatan')

@section('content')
<div class="mb-4">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small fw-semibold"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke Dashboard</a>
    <h2 class="fw-bold mt-2 mb-1" style="font-family:serif">Kegiatan Masjid</h2>
    <p class="text-muted mb-0">Agenda dan program resmi Masjid Jami Cicangkudu.</p>
</div>
<div class="row g-4">
    @forelse($kegiatan as $item)
    <div class="col-md-6 col-lg-4"><article class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius:1rem;">@if($item->image_path)<img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->title }}" style="height:180px;object-fit:cover" class="w-100">@else<div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="height:180px"><i class="fa-solid fa-calendar-days fa-3x"></i></div>@endif<div class="card-body p-4 d-flex flex-column"><div class="d-flex justify-content-between gap-2 mb-2"><span class="badge bg-success">Kegiatan</span>@if($item->event_date)<small class="text-muted"><i class="fa-regular fa-calendar me-1"></i>{{ $item->event_date->translatedFormat('d M Y') }}</small>@endif</div><h5 class="fw-bold">{{ $item->title }}</h5><p class="text-muted small mb-0">{{ $item->description ?: 'Informasi kegiatan Masjid Jami Cicangkudu.' }}</p></div></article></div>
    @empty
    <div class="col-12"><div class="card border-0 bg-light"><div class="card-body text-center text-muted py-5"><i class="fa-solid fa-calendar-xmark fa-2x mb-3 d-block"></i>Belum ada kegiatan yang diterbitkan.</div></div></div>
    @endforelse
</div>
@endsection
