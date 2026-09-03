<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WargaProfileController extends Controller
{
    public function index()
    {
        $warga = Auth::user();
        return view('warga.profil', compact('warga'));
    }

    // Memproses update data profil
    public function update(Request $request)
    {
        /** @var \App\Models\User $warga */
        $warga = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $warga->name = $request->nama_lengkap;
        if ($request->filled('password')) {
            $warga->password = Hash::make($request->password);
        }

        $warga->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }
}
