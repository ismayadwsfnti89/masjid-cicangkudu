@extends('warga.layout')
@section('title', 'Notifikasi | Masjid Jami Cicangkudu')
@section('header', 'Notifikasi')
@section('content')
<div class="mb-4"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted small"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard</a><h2 class="fw-bold mt-2" style="font-family:serif">Notifikasi</h2></div>
<div class="card border-0 shadow-sm" style="border-radius:1rem"><div class="list-group list-group-flush">@forelse($notifications as $notification)<a href="{{ $notification->data['url'] ?? route('dashboard') }}" class="list-group-item list-group-item-action p-4"><div class="d-flex gap-3"><i class="fa-solid fa-bell text-success mt-1"></i><div><strong>{{ $notification->data['title'] }}</strong><p class="mb-1 text-muted">{{ $notification->data['message'] }}</p><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></div></div></a>@empty<div class="p-4 text-muted">Belum ada notifikasi.</div>@endforelse</div></div>
@endsection
