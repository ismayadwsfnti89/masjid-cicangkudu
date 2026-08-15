<?php

namespace App\Imports;

use App\Models\User;
use App\Models\WargaProfile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row['name'],
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
        ]);

        WargaProfile::create([
            'user_id' => $user->id,
            'no_hp' => $row['no_hp'] ?? null,
            'alamat' => $row['alamat'] ?? null,
        ]);

        return $user;
    }
}