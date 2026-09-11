<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\KasPayment;
use App\Models\MasjidContent;
use App\Models\MasjidProfile;
use App\Models\PaymentSetting;
use App\Models\User;
use App\Notifications\ContentPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContentController extends Controller
{
    private const SECTIONS = [
        'kegiatan' => ['label' => 'Kegiatan', 'icon' => 'fa-calendar-days', 'requires_amount' => false],
        'donasi' => ['label' => 'Program Donasi', 'icon' => 'fa-hand-holding-heart', 'requires_amount' => true],
        'laporan-keuangan' => ['label' => 'Laporan Keuangan', 'icon' => 'fa-file-invoice-dollar', 'requires_amount' => true],
        'informasi-masjid' => ['label' => 'Informasi & Kegiatan Masjid', 'icon' => 'fa-mosque', 'requires_amount' => false],
    ];

    public function index(string $section)
    {
        $meta = $this->section($section);

        $contents = MasjidContent::whereIn('type', $this->contentTypesFor($section))
            ->latest('event_date')
            ->latest()
            ->get();

        if ($section === 'laporan-keuangan') {
            $manualContents = $contents
                ->filter(fn (MasjidContent $content) => in_array($content->transaction_type, ['pemasukan', 'pengeluaran'], true))
                ->values();

            $totalPemasukan = $manualContents
                ->where('transaction_type', 'pemasukan')
                ->sum('amount');

            $totalPemasukan += KasPayment::where('status', 'verified')->sum('nominal');

            $totalPengeluaran = $manualContents
                ->where('transaction_type', 'pengeluaran')
                ->sum('amount');

            $saldo = $totalPemasukan - $totalPengeluaran;

            $kasRows = KasPayment::with(['family', 'payer.wargaProfile'])
                ->where('status', 'verified')
                ->get()
                ->map(fn (KasPayment $payment) => (object) [
                    'id' => $payment->id,
                    'event_date' => $payment->tanggal_pembayaran,
                    'title' => 'Kas KK '.$payment->family->no_kk,
                    'description' => 'Pembayaran '.($payment->payer?->name ?? 'anggota KK'),
                    'amount' => $payment->nominal,
                    'transaction_type' => 'pemasukan',
                    'status' => 'published',
                    'donation_id' => null,
                    'is_kas_kk' => true,
                ]);
            $contents = collect($manualContents->each(fn (MasjidContent $content) => $content->is_kas_kk = false))
                ->merge($kasRows)
                ->sortByDesc('event_date')
                ->values();

            return view('admin.kelola_laporan', compact(
                'section',
                'meta',
                'contents',
                'totalPemasukan',
                'totalPengeluaran',
                'saldo',
            ));
        }

        $donations = $section === 'donasi'
            ? Donation::with(['user', 'program'])->latest()->get()
            : collect();

        $paymentSetting = $section === 'donasi'
            ? PaymentSetting::first()
            : null;
        $masjidProfile = $section === 'informasi-masjid' ? MasjidProfile::first() : null;

        return view(
            'admin.contents.index',
            compact(
                'section',
                'meta',
                'contents',
                'donations',
                'paymentSetting',
                'masjidProfile',
            )
        );
    }

    public function wargaKegiatan()
    {
        return redirect()->route('informasi');
    }

    public function create(string $section)
    {
        $meta = $this->section($section);

        return view('admin.contents.form', compact('section', 'meta'));
    }

    public function store(Request $request, string $section)
    {
        $meta = $this->section($section);
        $data = $this->validated($request, $section);

        $data['type'] = $section === 'informasi-masjid' ? $data['content_type'] : $section;
        unset($data['content_type']);
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
        $this->ensureContentMatchesSection($section, $content);

        return view('admin.contents.form', compact('section', 'meta', 'content'));
    }

    public function update(Request $request, string $section, MasjidContent $content)
    {
        $meta = $this->section($section);
        $this->ensureContentMatchesSection($section, $content);
        $wasPublic = in_array($content->status, ['published', 'active'], true);
        $data = $this->validated($request, $section);
        if ($request->hasFile('image')) {
            $this->deleteImage($content->image_path);
            $data['image_path'] = $request->file('image')->store('masjid-content', 'public');
        }
        if ($section === 'informasi-masjid') {
            $data['type'] = $data['content_type'];
        }

        if ($section === 'laporan-keuangan') {
            $data['transaction_type'] = $content->transaction_type;
        }

        unset($data['content_type']);
        $content->update($data);
        if (! $wasPublic) {
            $this->notifyWargaIfPublished($content);
        }

        return redirect()->route('admin.contents.index', $section)->with('success', $meta['label'].' berhasil diperbarui.');
    }

    public function destroy(string $section, MasjidContent $content)
    {
        $meta = $this->section($section);
        $this->ensureContentMatchesSection($section, $content);
        $this->deleteImage($content->image_path);
        $content->delete();

        return redirect()->route('admin.contents.index', $section)->with('success', $meta['label'].' berhasil dihapus.');
    }

    public function bulkDestroy(Request $request, string $section)
    {
        $this->section($section);
        $data = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer'],
        ]);

        $contents = MasjidContent::whereIn('type', $this->contentTypesFor($section))
            ->whereIn('id', $data['ids'])
            ->get();

        foreach ($contents as $content) {
            $this->deleteImage($content->image_path);
            $content->delete();
        }

        return redirect()
            ->route('admin.contents.index', $section)
            ->with('success', $contents->count().' data berhasil dihapus.');
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
            'amount' => [
                $meta['requires_amount'] ? 'required' : 'nullable',
                'numeric',
                'min:0',
            ],
            'transaction_type' => [
                $section === 'laporan-keuangan' ? 'required' : 'nullable',
                'in:pemasukan,pengeluaran',
            ],
            'content_type' => [
                $section === 'informasi-masjid' ? 'required' : 'nullable',
                'in:informasi-masjid,kegiatan',
            ],
            'status' => ['required', 'in:draft,published,active,completed'],
        ]);
    }

    private function contentTypesFor(string $section): array
    {
        return $section === 'informasi-masjid' ? ['informasi-masjid', 'kegiatan'] : [$section];
    }

    private function ensureContentMatchesSection(string $section, MasjidContent $content): void
    {
        abort_unless(in_array($content->type, $this->contentTypesFor($section), true), 404);
    }

    private function deleteImage(?string $imagePath): void
    {
        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    private function notifyWargaIfPublished(MasjidContent $content): void
    {
        if (in_array($content->status, ['published', 'active'], true) && in_array($content->type, ['kegiatan', 'donasi', 'informasi-masjid'], true)) {
            User::where('role', 'warga')->get()->each->notify(new ContentPublished($content));
        }
    }
}
