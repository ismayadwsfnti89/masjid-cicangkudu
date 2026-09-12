<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Family;
use App\Models\WargaProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $cari = trim((string) $request->input('cari', ''));
        $users = User::query()
            ->with('wargaProfile')
            ->where('role', 'warga')
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($query) use ($cari) {
                    $query->where('name', 'like', "%{$cari}%")
                        ->orWhere('username', 'like', "%{$cari}%")
                        ->orWhere('email', 'like', "%{$cari}%")
                        ->orWhereHas('wargaProfile', function ($query) use ($cari) {
                            $query->where('nik', 'like', "%{$cari}%")
                                ->orWhere('no_hp', 'like', "%{$cari}%")
                                ->orWhere('alamat', 'like', "%{$cari}%")
                                ->orWhereHas('family', fn ($query) => $query->where('no_kk', 'like', "%{$cari}%"));
                        });
                });
            })
            ->orderBy('name')
            ->get();

        return view('admin.users', compact('users', 'cari'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        abort_if($user->id === auth()->id(), 422, 'Akun admin yang sedang digunakan tidak dapat dihapus.');
        abort_if($user->role === 'admin' && User::where('role', 'admin')->count() <= 1, 422, 'Minimal harus ada satu akun admin.');
        $user->delete();

        return redirect()->route($user->role === 'admin' ? 'admin.admins' : 'admin.users')->with('success', 'Akun berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $data = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer'],
        ]);

        $count = User::where('role', 'warga')
            ->whereIn('id', $data['ids'])
            ->delete();

        return redirect()->route('admin.users')->with('success', $count.' data warga berhasil dihapus.');
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
            'nik' => 'required|string|max:30|unique:warga_profiles,nik',
            'no_kk' => 'required|string|max:50',
            'golongan' => 'required|integer|in:1,2,3',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'] ?? $data['username'].'@warga.local',
            'password' => Hash::make($data['password']),
            'role' => 'warga',
        ]);
        $family = $this->findOrCreateFamily($data['no_kk'], (int) $data['golongan']);

        WargaProfile::create([
            'user_id' => $user->id,
            'nik' => $data['nik'] ?? null,
            'family_id' => $family->id,
            'no_hp' => $data['no_hp'] ?? null,
            'alamat' => $data['alamat'] ?? null,
        ]);

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
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'nik' => 'required_if:role,warga|nullable|string|max:30|unique:warga_profiles,nik,'.($user->wargaProfile?->id ?? 'NULL'),
            'no_kk' => 'nullable|string|max:50',
            'golongan' => 'nullable|integer|in:1,2,3',
            'role' => 'required|in:admin,warga',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $family = null;
        if ($request->role === 'warga' && $request->filled('no_kk')) {
            $family = $this->findOrCreateFamily($request->no_kk, (int) $request->golongan);
        }

        WargaProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nik' => $request->nik,
                'family_id' => $family?->id,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        );

        // Cek jika yang diedit adalah admin, kembalikan ke halaman kelola admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.admins')->with('success', 'Data admin berhasil diperbarui!');
        }

        // Jika warga, kembalikan ke halaman kelola warga
        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function adminIndex(Request $request)
    {
        $cari = trim((string) $request->input('cari', ''));
        $admins = User::query()
            ->where('role', 'admin')
            ->when($cari !== '', fn ($query) => $query->where(function ($query) use ($cari) {
                $query->where('name', 'like', "%{$cari}%")
                    ->orWhere('username', 'like', "%{$cari}%")
                    ->orWhere('email', 'like', "%{$cari}%");
            }))
            ->orderBy('name')
            ->get();

        return view('admin.kelola_admin', compact('admins', 'cari'));
    }

    public function createAdmin()
    {
        return view('admin.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'] ?? $data['username'].'@admin.local',
            'password' => Hash::make($data['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admins')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    private function findOrCreateFamily(string $noKk, int $golongan): Family
    {
        $noKk = strtoupper(trim($noKk));
        $family = Family::where('no_kk', $noKk)->first();

        if ($family) {
            return $family;
        }

        if (Family::count() >= 100) {
            abort(422, 'Batas 100 KK telah tercapai.');
        }

        return Family::create(['no_kk' => $noKk, 'golongan' => $golongan]);
    }
}
