<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\KasPayment;
use App\Models\User;
use App\Notifications\KasStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminKasKkController extends Controller
{
    public function index(Request $request)
    {
        [$bulan, $tahun] = $this->periode($request);
        $status = $request->input('status');

        $families = Family::with([
            'members.user',
            'kasPayments' => fn ($query) => $query->with('payer.wargaProfile')
                ->where('bulan', $bulan)->where('tahun', $tahun),
        ])->orderBy('no_kk')->get()->map(function (Family $family) {
            $family->paymentPeriode = $family->kasPayments->first();
            return $family;
        });

        if (in_array($status, ['pending', 'verified', 'rejected', 'belum_bayar'], true)) {
            $families = $families->filter(fn (Family $family) => ($family->paymentPeriode?->status ?? 'belum_bayar') === $status)->values();
        }

        $semuaKk = Family::count();
        $sudahBayar = KasPayment::where('bulan', $bulan)->where('tahun', $tahun)->where('status', 'verified')->count();
        $totalPemasukan = KasPayment::where('bulan', $bulan)->where('tahun', $tahun)->where('status', 'verified')->sum('nominal');

        return view('admin.kas-kk.index', compact('families', 'bulan', 'tahun', 'status', 'semuaKk', 'sudahBayar', 'totalPemasukan'));
    }

    public function create(Request $request)
    {
        [$bulan, $tahun] = $this->periode($request);
        return view('admin.kas-kk.form', ['families' => $this->families(), 'warga' => $this->warga(), 'bulan' => $bulan, 'tahun' => $tahun]);
    }

    public function store(Request $request)
    {
        KasPayment::create($this->validated($request));
        return redirect()->route('admin.kas-kk.index', $request->only('bulan', 'tahun'))->with('success', 'Catatan kas KK berhasil ditambahkan.');
    }

    public function show(KasPayment $kasKk)
    {
        $kasKk->load('family.members.user', 'payer.wargaProfile');
        return view('admin.kas-kk.show', compact('kasKk'));
    }

    public function edit(KasPayment $kasKk)
    {
        return view('admin.kas-kk.form', ['kasKk' => $kasKk, 'families' => $this->families(), 'warga' => $this->warga(), 'bulan' => $kasKk->bulan, 'tahun' => $kasKk->tahun]);
    }

    public function update(Request $request, KasPayment $kasKk)
    {
        $kasKk->update($this->validated($request, $kasKk));
        return redirect()->route('admin.kas-kk.index', ['bulan' => $kasKk->bulan, 'tahun' => $kasKk->tahun])->with('success', 'Catatan kas KK berhasil diperbarui.');
    }

    public function destroy(KasPayment $kasKk)
    {
        if ($kasKk->proof_path) {
            Storage::disk('public')->delete($kasKk->proof_path);
        }
        $kasKk->delete();
        return back()->with('success', 'Catatan kas KK berhasil dihapus.');
    }

    public function verify(KasPayment $kasKk)
    {
        abort_unless($kasKk->status === 'pending', 422, 'Pembayaran kas ini sudah diproses.');
        $kasKk->update(['status' => 'verified']);
        $this->notifyFamily($kasKk->fresh('family.members.user'), true);
        return back()->with('success', 'Pembayaran kas berhasil diverifikasi dan masuk ke laporan.');
    }

    public function reject(KasPayment $kasKk)
    {
        abort_unless($kasKk->status === 'pending', 422, 'Pembayaran kas ini sudah diproses.');
        $kasKk->update(['status' => 'rejected']);
        $this->notifyFamily($kasKk->fresh('family.members.user'), false);
        return back()->with('success', 'Bukti pembayaran kas ditolak. Warga dapat mengunggah ulang bukti.');
    }

    private function notifyFamily(KasPayment $payment, bool $verified): void
    {
        $payment->family->members->pluck('user')->filter()->each->notify(new KasStatusUpdated($payment, $verified));
    }

    private function validated(Request $request, ?KasPayment $payment = null): array
    {
        $data = $request->validate([
            'family_id' => ['required', Rule::exists('families', 'id')],
            'user_id' => ['nullable', Rule::exists('users', 'id')->where('role', 'warga')],
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'between:2020,2100'],
            'tanggal_pembayaran' => ['nullable', 'date', 'required_if:status,verified'],
            'status' => ['required', Rule::in(['verified', 'rejected'])],
        ]);

        $family = Family::findOrFail($data['family_id']);
        $exists = KasPayment::where('family_id', $family->id)->where('bulan', $data['bulan'])->where('tahun', $data['tahun'])
            ->when($payment, fn ($query) => $query->whereKeyNot($payment->id))->exists();
        if ($exists) {
            throw \Illuminate\Validation\ValidationException::withMessages(['family_id' => 'KK ini sudah memiliki catatan kas pada periode tersebut.']);
        }

        if ($data['status'] === 'verified') {
            $isMember = User::whereKey($data['user_id'])->whereHas('wargaProfile', fn ($query) => $query->where('family_id', $family->id))->exists();
            if (! $isMember) {
                throw \Illuminate\Validation\ValidationException::withMessages(['user_id' => 'Pembayar harus merupakan anggota dari KK yang dipilih.']);
            }
        } else {
            $data['user_id'] = null;
            $data['tanggal_pembayaran'] = null;
        }

        $data['golongan'] = $family->golongan;
        $data['nominal'] = $family->nominal_kas;
        return $data;
    }

    private function families()
    {
        return Family::orderBy('no_kk')->get();
    }

    private function warga()
    {
        return User::with('wargaProfile.family')->where('role', 'warga')->orderBy('name')->get();
    }

    private function periode(Request $request): array
    {
        return [min(12, max(1, (int) $request->input('bulan', now()->month))), min(2100, max(2020, (int) $request->input('tahun', now()->year)))];
    }
}
