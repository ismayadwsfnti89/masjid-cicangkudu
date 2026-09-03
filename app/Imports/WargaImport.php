<?php

namespace App\Imports;

use App\Models\User;
use App\Models\WargaProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WargaImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $nama = trim((string) ($row['nama'] ?? $row['name'] ?? $row['nama_lengkap'] ?? ''));

                if ($nama === '') {
                    continue;
                }

                $username = trim((string) ($row['username'] ?? ''));
                $username = $username !== '' ? $username : $this->uniqueUsername($nama);

                $user = User::firstOrNew(['username' => $username]);
                $isNewUser = ! $user->exists;
                $email = trim((string) ($row['email'] ?? ''));

                $user->fill([
                    'name' => $nama,
                    'email' => $email !== '' ? $email : ($user->email ?: $this->generatedEmail($username, $user->id)),
                    'role' => 'warga',
                ]);

                if ($isNewUser) {
                    $user->password = Hash::make('123456');
                }

                $user->save();

                WargaProfile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'no_hp' => $row['no_hp'] ?? $row['nomor_hp'] ?? $row['telepon'] ?? null,
                        'alamat' => $row['alamat'] ?? null,
                    ]
                );
            }
        });
    }

    private function uniqueUsername(string $nama): string
    {
        $base = Str::slug($nama, '') ?: 'warga';
        $username = $base;
        $number = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base.$number++;
        }

        return $username;
    }

    private function generatedEmail(string $username, ?int $currentUserId): string
    {
        $base = Str::slug($username, '.') ?: 'warga';
        $email = $base.'@warga.local';
        $number = 1;

        while (User::where('email', $email)->when($currentUserId, fn ($query) => $query->whereKeyNot($currentUserId))->exists()) {
            $email = $base.$number++.'@warga.local';
        }

        return $email;
    }
}
