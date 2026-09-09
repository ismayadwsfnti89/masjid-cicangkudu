@extends('admin.layout')

@section('title', 'Notifikasi Admin | Masjid Jami Cicangkudu')
@section('header', 'Notifikasi admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small fw-semibold"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard</a>
    <h2 class="fw-bold mt-2 mb-1" style="font-family:serif">Notifikasi</h2>
    <p class="text-muted mb-0">Bukti donasi dan pembaruan yang memerlukan perhatian admin.</p>
</div>
<div class="card border-0 shadow-sm" style="border-radius:1rem"><div class="list-group list-group-flush">@forelse($notifications as $notification)<a href="{{ $notification->data['url'] ?? route('admin.contents.index', 'donasi') }}" class="list-group-item list-group-item-action p-4"><div class="d-flex gap-3"><span class="activity-icon"><i class="fa-solid fa-bell"></i></span><div><strong>{{ $notification->data['title'] ?? 'Notifikasi admin' }}</strong><p class="mb-1 text-muted">{{ $notification->data['message'] ?? 'Ada pembaruan baru.' }}</p><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></div></div></a>@empty<div class="p-4 text-muted text-center">Belum ada notifikasi.</div>@endforelse</div></div>
@endsection
