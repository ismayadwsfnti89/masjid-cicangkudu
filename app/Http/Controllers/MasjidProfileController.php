<?php

namespace App\Http\Controllers;

use App\Models\MasjidProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasjidProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'masjid_type' => ['required', 'string', 'max:100'],
            'open_hours' => ['required', 'string', 'max:100'],
            'activity_label' => ['required', 'string', 'max:100'],
            'vision' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Ambil profil masjid pertama.
        // Kalau belum ada, buat data baru.
        $profile = MasjidProfile::firstOrNew();

        // Kalau ada gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama hanya jika memang ada
            if (!empty($profile->image_path)) {
                Storage::disk('public')->delete($profile->image_path);
            }

            // Simpan gambar baru
            $data['image_path'] = $request
                ->file('image')
                ->store('masjid-profile', 'public');
        }

        // Jangan simpan field upload "image"
        unset($data['image']);

        // Simpan data profil
        $profile->fill($data);
        $profile->save();

        return redirect()
            ->route('admin.contents.index', 'informasi-masjid')
            ->with('success', 'Profil masjid berhasil diperbarui.');
    }
}
