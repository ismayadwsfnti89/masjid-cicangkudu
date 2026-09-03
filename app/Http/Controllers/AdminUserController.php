<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WargaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        // Hanya ambil user yang rolenya 'warga' saja agar admin tidak ikut tampil
        $users = User::with('wargaProfile')->where('role', 'warga')->get();
        return view('admin.users', compact('users'));
    }

    public function destroy($id)
    {
        // Menghapus data warga jika diperlukan
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Data warga berhasil dihapus!');
    }

    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'] ?? $data['username'].'@warga.local',
            'password' => Hash::make($data['password']),
            'role' => 'warga',
        ]);
        WargaProfile::create(['user_id' => $user->id, 'no_hp' => $data['no_hp'] ?? null, 'alamat' => $data['alamat'] ?? null]);

        return redirect()->route('admin.users')->with('success', 'Warga berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->load('wargaProfile');
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'role' => 'required|in:admin,warga',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        WargaProfile::updateOrCreate(
            ['user_id' => $user->id],
            ['no_hp' => $request->no_hp, 'alamat' => $request->alamat]
        );

        // Cek jika yang diedit adalah admin, kembalikan ke halaman kelola admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.admins')->with('success', 'Data admin berhasil diperbarui!');
        }

        // Jika warga, kembalikan ke halaman kelola warga
        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui!');
    }
    public function adminIndex()
    {
        // Hanya mengambil user yang memiliki role 'admin'
        $admins = User::where('role', 'admin')->get();
        return view('admin.kelola_admin', compact('admins'));
    }
}
