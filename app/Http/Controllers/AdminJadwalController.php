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

        // ID wilayah Kabupaten Tasikmalaya
        $idWilayah = '045117b0e0a11a242b9765e79cbf113f';

        $response = Http::timeout(10)->get(
            "https://api.myquran.com/v3/sholat/jadwal/{$idWilayah}/{$tahun}-{$bulan}"
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