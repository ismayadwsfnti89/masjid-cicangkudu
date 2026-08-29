<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class WargaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $nama = $row['name'] ?? $row['nama'] ?? 'Tanpa Nama';
        $username = $row['username'] ?? strtolower(str_replace(' ', '', $nama)) . rand(100,999);

        return new User([
            'name'     => $nama,
            'username' => $username,
            'email'    => null, // Email dikosongkan total
            'password' => Hash::make('123456'),
            'role'     => 'warga',
            'no_hp'    => $row['no_hp'] ?? $row['telepon'] ?? null,
            'alamat'   => $row['alamat'] ?? null,
        ]);
    }
}