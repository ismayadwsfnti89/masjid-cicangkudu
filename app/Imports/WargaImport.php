<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\User;
use App\Models\WargaProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $index => $row) {
                $baris = $index + 2;
                $nama = trim((string) ($row['nama'] ?? $row['name'] ?? $row['nama_lengkap'] ?? ''));
                $nik = trim((string) ($row['nik'] ?? ''));
                $noKk = strtoupper(trim((string) ($row['no_kk'] ?? $row['nomor_kk'] ?? '')));
                $golongan = $this->golongan($row['golongan'] ?? null);

                if ($nama === '' && $nik === '' && $noKk === '') {
                    continue;
                }

                if ($nama === '' || $nik === '' || $noKk === '' || ! $golongan) {
                    throw ValidationException::withMessages([
                        'file' => "Baris {$baris}: nama, NIK, No. KK, dan golongan wajib diisi.",
                    ]);
                }

                $family = Family::where('no_kk', $noKk)->first();
                if ($family && $family->golongan !== $golongan) {
                    throw ValidationException::withMessages([
                        'file' => "Baris {$baris}: golongan KK {$noKk} tidak sama dengan data KK yang sudah ada.",
                    ]);
                }
                if (! $family) {
                    if (Family::count() >= 100) {
                        throw ValidationException::withMessages(['file' => 'Batas maksimal 100 KK telah tercapai.']);
                    }
                    $family = Family::create(['no_kk' => $noKk, 'golongan' => $golongan]);
                }

                $profile = WargaProfile::where('nik', $nik)->first();
                $username = trim((string) ($row['username'] ?? ''));
                $user = $profile?->user ?? ($username !== '' ? User::where('username', $username)->first() : null);
                $isNewUser = ! $user;
                $username = $username !== '' ? $username : ($user?->username ?? $this->uniqueUsername($nama));
                $email = trim((string) ($row['email'] ?? ''));

                if (! $user) {
                    $user = new User();
                    $user->username = $username;
                    $user->password = Hash::make('123456');
                }

                $user->fill([
                    'name' => $nama,
                    'email' => $email !== '' ? $email : ($user->email ?: $this->generatedEmail($username, $user->id)),
                    'role' => 'warga',
                ]);
                $user->save();

                WargaProfile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nik' => $nik,
                        'family_id' => $family->id,
                        'no_hp' => $row['no_hp'] ?? $row['nomor_hp'] ?? $row['telepon'] ?? null,
                        'alamat' => $row['alamat'] ?? null,
                    ],
                );
            }
        });
    }

    private function golongan(mixed $value): ?int
    {
        preg_match('/[123]/', (string) $value, $matches);
        return isset($matches[0]) ? (int) $matches[0] : null;
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
