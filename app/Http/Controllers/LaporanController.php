<?php

namespace App\Http\Controllers;

use App\Models\KasPayment;
use App\Models\Family;
use App\Models\MasjidContent;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));

        if (! preg_match('/^\d{4}-\d{2}$/', $bulan)) {
            $bulan = now()->format('Y-m');
        }

        [$tahun, $nomorBulan] = explode('-', $bulan);

        $transaksiLaporan = MasjidContent::where('type', 'laporan-keuangan')
            ->whereIn('status', ['published', 'active'])
            ->whereIn('transaction_type', ['pemasukan', 'pengeluaran'])
            ->whereNotNull('event_date')
            ->whereYear('event_date', $tahun)
            ->whereMonth('event_date', $nomorBulan)
            ->orderBy('event_date', 'asc')
            ->get();

        $totalPemasukanNonKas = $transaksiLaporan
            ->where('transaction_type', 'pemasukan')
            ->sum('amount');

        $totalPengeluaran = $transaksiLaporan
            ->where('transaction_type', 'pengeluaran')
            ->sum('amount');

        $semuaKasPayments = KasPayment::with(['family', 'payer.wargaProfile'])
            ->where('bulan', $nomorBulan)
            ->where('tahun', $tahun)
            ->orderByDesc('tanggal_pembayaran')
            ->get();

        $familyId = $request->user()?->wargaProfile?->family_id;
        $kasPayments = $familyId
            ? $semuaKasPayments->where('family_id', $familyId)->values()
            : collect();

        $pemasukanKas = $semuaKasPayments
            ->where('status', 'verified')
            ->sum('nominal');
        $jumlahSudahBayar = $semuaKasPayments->where('status', 'verified')->count();
        $jumlahBelumBayar = max(0, Family::count() - $jumlahSudahBayar);

        $totalPemasukan = $totalPemasukanNonKas + $pemasukanKas;
        $saldo = $totalPemasukan - $totalPengeluaran;

        $transaksi = $kasPayments->where('status', 'verified')->map(function (KasPayment $payment) {
            return (object) [
                'event_date' => $payment->tanggal_pembayaran,
                'title' => 'Kas KK '.$payment->family->no_kk,
                'amount' => $payment->nominal,
                'transaction_type' => 'pemasukan',
                'donation_id' => null,
                'is_kas_kk' => true,
            ];
        })->sortBy('event_date')->values();

        $bulanOptions = collect();

        for ($i = 0; $i < 12; $i++) {
            $tanggal = now()->subMonths($i);

            $bulanOptions->push([
                'value' => $tanggal->format('Y-m'),
                'label' => $tanggal->translatedFormat('F Y'),
            ]);
        }

        return view('warga.laporan', compact(
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'bulan',
            'bulanOptions',
            'kasPayments',
            'pemasukanKas',
            'jumlahSudahBayar',
            'jumlahBelumBayar',
        ));
    }
}
