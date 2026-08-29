<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Hanya ambil user yang rolenya 'warga' saja agar admin tidak ikut tampil
        $users = User::where('role', 'warga')->get();
        return view('admin.users', compact('users'));
    }

    public function destroy($id)
    {
        // Menghapus data warga jika diperlukan
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Data warga berhasil dihapus!');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
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
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

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
