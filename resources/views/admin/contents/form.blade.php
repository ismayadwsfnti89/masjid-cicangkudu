@extends('admin.layout')

@section('title', (isset($content) ? 'Edit' : 'Tambah').' '.$meta['label'].' | Admin Masjid')
@section('header', 'Kelola '.$meta['label'])

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.contents.index', $section) }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center mb-2"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke {{ $meta['label'] }}</a>
    <h2 class="fw-bold mb-1" style="color: #111d13; font-family: serif;">{{ isset($content) ? 'Edit' : 'Tambah' }} {{ $meta['label'] }}</h2>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 1rem;"><div class="card-body p-4">
    <form method="POST" enctype="multipart/form-data" action="{{ isset($content) ? route('admin.contents.update', [$section, $content]) : route('admin.contents.store', $section) }}">
        @csrf @isset($content) @method('PUT') @endisset
        <div class="mb-3">
            <label class="form-label fw-semibold" for="title">Judul</label>
            <input id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $content->title ?? '') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="image">Gambar {{ $section === 'informasi-masjid' ? '/ Foto Berita' : '(opsional)' }}</label>
            <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control @error('image') is-invalid @enderror">
            @if(isset($content) && $content->image_path)<img src="{{ asset('storage/'.$content->image_path) }}" class="img-thumbnail mt-2" style="max-height: 120px" alt="Gambar saat ini">@endif
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $content->description ?? '') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-{{ $meta['requires_amount'] ? '4' : '6' }}"><label class="form-label fw-semibold" for="event_date">Tanggal</label><input id="event_date" type="date" name="event_date" class="form-control" value="{{ old('event_date', isset($content) && $content->event_date ? $content->event_date->format('Y-m-d') : '') }}"></div>
            @if($meta['requires_amount'])<div class="col-md-4"><label class="form-label fw-semibold" for="amount">Nominal (Rp)</label><input id="amount" type="number" min="0" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $content->amount ?? '') }}" required>@error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>@endif
            <div class="col-md-{{ $meta['requires_amount'] ? '4' : '6' }}"><label class="form-label fw-semibold" for="status">Status</label><select id="status" name="status" class="form-select" required>@foreach(['draft' => 'Draf', 'published' => 'Terbit', 'active' => 'Aktif', 'completed' => 'Selesai'] as $value => $label)<option value="{{ $value }}" @selected(old('status', $content->status ?? 'draft') === $value)>{{ $label }}</option>@endforeach</select></div>
        </div>
        <div class="d-flex justify-content-end gap-2"><a href="{{ route('admin.contents.index', $section) }}" class="btn btn-light">Batal</a><button class="btn btn-success px-4"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan</button></div>
    </form>
</div></div>
@endsection
