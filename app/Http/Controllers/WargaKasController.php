<?php

namespace App\Http\Controllers;

use App\Models\KasPayment;
use App\Models\User;
use App\Notifications\KasProofSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaKasController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->load('wargaProfile.family')->wargaProfile;
        $family = $profile?->family;
        $bulan = (int) $request->input('bulan', now()->month);
        $tahun = (int) $request->input('tahun', now()->year);
        $bulan = min(12, max(1, $bulan));
        $tahun = min(2100, max(2020, $tahun));

        $payments = $family
            ? KasPayment::with('payer.wargaProfile')->where('family_id', $family->id)->latest('tahun')->latest('bulan')->get()
            : collect();
        $paymentPeriode = $payments->first(fn (KasPayment $payment) => $payment->bulan === $bulan && $payment->tahun === $tahun);

        return view('warga.kas', compact('profile', 'family', 'payments', 'paymentPeriode', 'bulan', 'tahun'));
    }

    public function pay(Request $request)
    {
        $profile = $request->user()->load('wargaProfile.family')->wargaProfile;
        abort_unless($profile?->family, 422, 'Akun Anda belum terhubung ke data KK. Hubungi pengurus.');

        $data = $request->validate([
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'between:2020,2100'],
            'proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);
        $family = $profile->family;

        $payment = DB::transaction(function () use ($data, $family, $request) {
            $payment = KasPayment::where('family_id', $family->id)->where('bulan', $data['bulan'])->where('tahun', $data['tahun'])->lockForUpdate()->first();
            if (in_array($payment?->status, ['pending', 'verified'], true)) {
                abort(422, 'Kas KK untuk periode ini sudah dibayar atau sedang menunggu verifikasi.');
            }

            return KasPayment::updateOrCreate(
                ['family_id' => $family->id, 'bulan' => $data['bulan'], 'tahun' => $data['tahun']],
                [
                    'user_id' => $request->user()->id,
                    'golongan' => $family->golongan,
                    'nominal' => $family->nominal_kas,
                    'tanggal_pembayaran' => now()->toDateString(),
                    'proof_path' => $request->file('proof')->store('kas-proofs', 'public'),
                    'status' => 'pending',
                ],
            );
        });

        $payment->load('family');
        User::where('role', 'admin')->get()->each->notify(new KasProofSubmitted($payment));

        return redirect()->route('kas.saya', $data)->with('success', 'Bukti pembayaran kas berhasil dikirim. Pengurus akan memverifikasinya.');
    }
}
