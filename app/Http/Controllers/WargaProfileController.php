<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\WargaProfile;
use App\Models\User;
use Illuminate\Validation\Rule;

class WargaProfileController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $warga */
        // $warga = Auth::user()->load('wargaProfile');
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
            'username' => ['required', 'string', 'min:3', 'max:255', Rule::unique('users', 'username')->ignore($warga->id)],
            'password' => 'nullable|string|min:8',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Update nama
        $warga->name = $request->nama_lengkap;
        $warga->username = $request->username;

        // Update password jika diisi
        if ($request->filled('password')) {
            $warga->password = Hash::make($request->password);
        }

        $warga->save();

        // Ambil atau buat profil warga
        $profile = WargaProfile::firstOrCreate([
            'user_id' => $warga->id
        ]);

        // Jika user mengupload avatar baru
        if ($request->hasFile('avatar')) {

            // Hapus avatar lama hanya jika ada
            if (!empty($profile->avatar_path)) {
                Storage::disk('public')->delete($profile->avatar_path);
            }

            // Simpan avatar baru
            $profile->avatar_path = $request
                ->file('avatar')
                ->store('warga-avatars', 'public');

            $profile->save();
        }

        return redirect()
            ->route('profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
