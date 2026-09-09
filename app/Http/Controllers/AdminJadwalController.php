<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        $tahun = date('Y');
        $bulan = date('m');

        $response = Http::timeout(10)->get(
            "https://api.myquran.com/v2/sholat/jadwal/1218/{$tahun}/{$bulan}"
        );

        if ($response->successful()) {
            $jadwalList = $response->json()['data']['jadwal'] ?? [];
        } else {
            $jadwalList = [];
        }

        return view(
            'admin.kelola_jadwal',
            compact('jadwalList')
        );
    }
}
