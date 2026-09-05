<?php

namespace App\Http\Controllers;

use App\Models\MasjidContent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Bulan yang dipilih, default bulan sekarang
        $bulan = $request->input('bulan', now()->format('Y-m'));

        // Pecah tahun dan bulan
        [$tahun, $nomorBulan] = explode('-', $bulan);

        // Ambil laporan keuangan asli dari database
        $transaksi = MasjidContent::where('type', 'laporan-keuangan')
            ->whereIn('status', ['published', 'active'])
            ->whereNotNull('event_date')
            ->whereYear('event_date', $tahun)
            ->whereMonth('event_date', $nomorBulan)
            ->orderByDesc('event_date')
            ->get();

        // Hitung total pemasukan
        $totalPemasukan = $transaksi
            ->where('transaction_type', 'pemasukan')
            ->sum('amount');

        // Hitung total pengeluaran
        $totalPengeluaran = $transaksi
            ->where('transaction_type', 'pengeluaran')
            ->sum('amount');

        // Hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Pilihan bulan untuk filter
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