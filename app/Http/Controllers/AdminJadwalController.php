<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        $hariIni = now('Asia/Jakarta');
        $tahun = $request->integer('tahun', $hariIni->year);
        $bulan = $request->integer('bulan', $hariIni->month);

        if ($tahun < 2016 || $tahun > $hariIni->year + 1) {
            $tahun = $hariIni->year;
        }

        if ($bulan < 1 || $bulan > 12) {
            $bulan = $hariIni->month;
        }

        $response = Http::timeout(10)->get(
            "https://api.myquran.com/v2/sholat/jadwal/1218/{$tahun}/{$bulan}"
        );

        if ($response->successful()) {
            $jadwalList = $response->json()['data']['jadwal'] ?? [];
            $tanggalHariIni = $hariIni->toDateString();
            usort($jadwalList, function (array $a, array $b) use ($tanggalHariIni) {
                $aLewat = ($a['date'] ?? '') < $tanggalHariIni;
                $bLewat = ($b['date'] ?? '') < $tanggalHariIni;
                if ($aLewat !== $bLewat) {
                    return $aLewat ? 1 : -1;
                }
                return strcmp($a['date'] ?? '', $b['date'] ?? '');
            });
        } else {
            $jadwalList = [];
        }

        return view(
            'admin.kelola_jadwal',
            [
                'jadwalList' => $jadwalList,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'tahunOptions' => range($hariIni->year + 1, 2016),
                'bulanOptions' => collect(range(1, 12))->mapWithKeys(
                    fn (int $nomorBulan) => [$nomorBulan => Carbon::create()->month($nomorBulan)->translatedFormat('F')]
                ),
            ]
        );
    }
}
