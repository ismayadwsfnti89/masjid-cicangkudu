<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));

        if (!preg_match('/^\d{4}-\d{2}$/', $bulan)) {
            $bulan = now()->format('Y-m');
        }

        [$tahun, $nomorBulan] = explode('-', $bulan);

        $transaksi = MasjidContent::where('type', 'laporan-keuangan')
            ->whereIn('status', ['published', 'active'])
            ->whereNotNull('event_date')
            ->whereYear('event_date', $tahun)
            ->whereMonth('event_date', $nomorBulan)
            ->orderBy('event_date', 'asc')
            ->get();

        $totalPemasukan = $transaksi
            ->where('transaction_type', 'pemasukan')
            ->sum('amount');

        $totalPengeluaran = $transaksi
            ->where('transaction_type', 'pengeluaran')
            ->sum('amount');

        $saldo = $totalPemasukan - $totalPengeluaran;

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
            'bulanOptions'
        ));
    }
}