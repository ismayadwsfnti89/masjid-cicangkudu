<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;
use App\Models\PaymentSetting;
use App\Models\User;
use App\Notifications\ContentPublished;

class AdminContentController extends Controller
{
    private const SECTIONS = [
        'kegiatan' => ['label' => 'Kegiatan', 'icon' => 'fa-calendar-days', 'requires_amount' => false],
        'donasi' => ['label' => 'Program Donasi', 'icon' => 'fa-hand-holding-heart', 'requires_amount' => true],
        'laporan-keuangan' => ['label' => 'Laporan Keuangan', 'icon' => 'fa-file-invoice-dollar', 'requires_amount' => true],
        'informasi-masjid' => ['label' => 'Informasi Masjid', 'icon' => 'fa-mosque', 'requires_amount' => false],
    ];

    public function index(string $section)
    {
        $meta = $this->section($section);
        $contents = MasjidContent::where('type', $section)->latest('event_date')->latest()->get();
        $donations = $section === 'donasi'
            ? Donation::with(['user', 'program'])->latest()->get()
            : collect();
        $paymentSetting = $section === 'donasi' ? PaymentSetting::first() : null;

        return view('admin.contents.index', compact('section', 'meta', 'contents', 'donations', 'paymentSetting'));
    }

    public function create(string $section)
    {
        $meta = $this->section($section);

        return view('admin.contents.form', compact('section', 'meta'));
    }

    public function store(Request $request, string $section)
    {
        $meta = $this->section($section);
        $data = $this->validated($request, $section) + ['type' => $section];
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('masjid-content', 'public');
        }
        $content = MasjidContent::create($data);
        $this->notifyWargaIfPublished($content);

        return redirect()->route('admin.contents.index', $section)->with('success', $meta['label'].' berhasil ditambahkan.');
    }

    public function edit(string $section, MasjidContent $content)
    {
        $meta = $this->section($section);
        abort_unless($content->type === $section, 404);

        return view('admin.contents.form', compact('section', 'meta', 'content'));
    }

    public function update(Request $request, string $section, MasjidContent $content)
    {
        $meta = $this->section($section);
        abort_unless($content->type === $section, 404);
        $wasPublic = in_array($content->status, ['published', 'active'], true);
        $data = $this->validated($request, $section);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($content->image_path);
            $data['image_path'] = $request->file('image')->store('masjid-content', 'public');
        }
        $content->update($data);
        if (! $wasPublic) $this->notifyWargaIfPublished($content);

        return redirect()->route('admin.contents.index', $section)->with('success', $meta['label'].' berhasil diperbarui.');
    }

    public function destroy(string $section, MasjidContent $content)
    {
        $meta = $this->section($section);
        abort_unless($content->type === $section, 404);
        Storage::disk('public')->delete($content->image_path);
        $content->delete();

        return redirect()->route('admin.contents.index', $section)->with('success', $meta['label'].' berhasil dihapus.');
    }

    private function section(string $section): array
    {
        abort_unless(array_key_exists($section, self::SECTIONS), 404);

        return self::SECTIONS[$section];
    }

    private function validated(Request $request, string $section): array
    {
        $meta = $this->section($section);

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'event_date' => ['nullable', 'date'],
            'amount' => [$meta['requires_amount'] ? 'required' : 'nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,published,active,completed'],
        ]);
    }

    private function notifyWargaIfPublished(MasjidContent $content): void
    {
        if (in_array($content->status, ['published', 'active'], true) && in_array($content->type, ['kegiatan', 'donasi', 'informasi-masjid'], true)) {
            User::where('role', 'warga')->get()->each->notify(new ContentPublished($content));
        }
    }
}
