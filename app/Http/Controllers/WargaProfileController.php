<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WargaProfileController extends Controller
{
    public function index()
    {
        return view('warga.profil');
    }

    // Memproses update data profil
    public function update(Request $request)
    {
        // Logika simpan data akan kita isi di langkah integrasi form
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
