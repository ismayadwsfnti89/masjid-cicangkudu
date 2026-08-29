<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        // Contoh mengambil jadwal bulan aktif (format: tahun/bulan)
        $tahun = date('Y');
        $bulan = date('m');
        
        // Contoh endpoint API (sesuaikan dengan API yang sedang digunakan pada project)
        $response = Http::get("https://api.myquran.com/v2/sholat/jadwal/1219/{$tahun}/{$bulan}");
        $jadwalList = $response->json()['data']['jadwal'] ?? [];

        return view('admin.kelola_jadwal', compact('jadwalList'));
    }
}