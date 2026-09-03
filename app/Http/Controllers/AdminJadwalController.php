<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        // Cicangkudu Mangunreja berada di Kabupaten Tasikmalaya; ID wilayah diverifikasi dari API MyQuran.
        $tahun = date('Y');
        $bulan = date('m');
        
        // Contoh endpoint API (sesuaikan dengan API yang sedang digunakan pada project)
        $response = Http::timeout(10)->get("https://api.myquran.com/v3/sholat/jadwal/045117b0e0a11a242b9765e79cbf113f/{$tahun}/{$bulan}");
        $jadwalList = $response->json()['data']['jadwal'] ?? [];

        return view('admin.kelola_jadwal', compact('jadwalList'));
    }
}
