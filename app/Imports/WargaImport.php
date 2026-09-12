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

            /*
            |--------------------------------------------------------------------------
            | 1. Ambil data KK yang sudah ada SEKALI
            |--------------------------------------------------------------------------
            */
            $families = Family::all()->keyBy('no_kk');

            /*
            |--------------------------------------------------------------------------
            | 2. Batasi maksimal 100 KK
            |--------------------------------------------------------------------------
            */
            $newKk = [];

            foreach ($rows as $row) {
                $noKk = strtoupper(trim(
                    (string) ($row['no_kk'] ?? $row['nomor_kk'] ?? '')
                ));

                if ($noKk !== '' && !isset($families[$noKk])) {
                    $newKk[$noKk] = true;
                }
            }

            if (($families->count() + count($newKk)) > 100) {
                throw ValidationException::withMessages([
                    'file' => 'Batas maksimal 100 KK telah tercapai.'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | 3. Buat KK baru sekaligus
            |--------------------------------------------------------------------------
            */
            foreach ($newKk as $noKk => $_) {

                // Cari baris pertama yang memiliki KK tersebut
                $row = $rows->first(function ($item) use ($noKk) {
                    $itemKk = strtoupper(trim(
                        (string) ($item['no_kk'] ?? $item['nomor_kk'] ?? '')
                    ));

                    return $itemKk === $noKk;
                });

                $golongan = $this->golongan($row['golongan'] ?? null);

                if (!$golongan) {
                    continue;
                }

                $family = Family::create([
                    'no_kk' => $noKk,
                    'golongan' => $golongan,
                ]);

                $families[$noKk] = $family;
            }

            /*
            |--------------------------------------------------------------------------
            | 4. Ambil user & profile yang sudah ada SEKALI
            |--------------------------------------------------------------------------
            */
            $existingUsers = User::all();

            $usersByUsername = $existingUsers
                ->filter(fn ($user) => !empty($user->username))
                ->keyBy('username');

            $usersByEmail = $existingUsers
                ->filter(fn ($user) => !empty($user->email))
                ->keyBy('email');

            $profiles = [];
            $existingProfiles = WargaProfile::with('user')
                ->whereNotNull('nik')
                ->get();

            foreach ($existingProfiles as $existingProfile) {
                if ($existingProfile instanceof WargaProfile && $existingProfile->nik) {
                    $profiles[$existingProfile->nik] = $existingProfile;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 5. Hash password default SATU KALI
            |--------------------------------------------------------------------------
            */
            $defaultPassword = Hash::make('123456');

            /*
            |--------------------------------------------------------------------------
            | 6. Proses data Excel
            |--------------------------------------------------------------------------
            */
            foreach ($rows as $index => $row) {

                $baris = $index + 2;

                $nama = trim(
                    (string) (
                        $row['nama']
                        ?? $row['name']
                        ?? $row['nama_lengkap']
                        ?? ''
                    )
                );

                $nik = trim(
                    (string) ($row['nik'] ?? '')
                );

                $noKk = strtoupper(
                    trim(
                        (string) (
                            $row['no_kk']
                            ?? $row['nomor_kk']
                            ?? ''
                        )
                    )
                );

                $golongan = $this->golongan(
                    $row['golongan'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Lewati baris kosong
                |--------------------------------------------------------------------------
                */
                if ($nama === '' && $nik === '' && $noKk === '') {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Validasi data wajib
                |--------------------------------------------------------------------------
                */
                if (
                    $nama === ''
                    || $nik === ''
                    || $noKk === ''
                    || !$golongan
                ) {
                    throw ValidationException::withMessages([
                        'file' =>
                            "Baris {$baris}: nama, NIK, No. KK, dan golongan wajib diisi."
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Ambil KK dari cache
                |--------------------------------------------------------------------------
                */
                $family = $families[$noKk] ?? null;

                if (!$family) {
                    throw ValidationException::withMessages([
                        'file' =>
                            "Baris {$baris}: No. KK {$noKk} tidak berhasil diproses."
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Pastikan golongan KK konsisten
                |--------------------------------------------------------------------------
                */
                if ((int) $family->golongan !== (int) $golongan) {
                    throw ValidationException::withMessages([
                        'file' =>
                            "Baris {$baris}: golongan KK {$noKk} tidak sama dengan data KK yang sudah ada."
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Cari user berdasarkan NIK terlebih dahulu
                |--------------------------------------------------------------------------
                */
                $profile = $profiles[$nik] ?? null;

                $usernameExcel = trim(
                    (string) ($row['username'] ?? '')
                );

                $user = $profile?->user;

                /*
                |--------------------------------------------------------------------------
                | Kalau belum ditemukan lewat NIK,
                | cari berdasarkan username
                |--------------------------------------------------------------------------
                */
                if (!$user && $usernameExcel !== '') {
                    $user = $usersByUsername[$usernameExcel] ?? null;
                }

                /*
                |--------------------------------------------------------------------------
                | Username baru
                |--------------------------------------------------------------------------
                */
                if (!$user) {

                    $username = $usernameExcel !== ''
                        ? $usernameExcel
                        : $this->makeUsername(
                            $nama,
                            $usersByUsername
                        );

                    $user = new User();

                    $user->username = $username;

                    /*
                    | Gunakan hash password yang dibuat satu kali.
                    */
                    $user->password = $defaultPassword;

                } else {

                    $username = $user->username;
                }

                /*
                |--------------------------------------------------------------------------
                | Email
                |--------------------------------------------------------------------------
                */
                $emailExcel = trim(
                    (string) ($row['email'] ?? '')
                );

                if ($emailExcel !== '') {

                    $email = $emailExcel;

                } elseif (!empty($user->email)) {

                    $email = $user->email;

                } else {

                    $email = $this->makeEmail(
                        $username,
                        $usersByEmail
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Update user
                |--------------------------------------------------------------------------
                */
                $user->name = $nama;
                $user->email = $email;
                $user->role = 'warga';

                $user->save();

                /*
                |--------------------------------------------------------------------------
                | Masukkan user ke cache
                |--------------------------------------------------------------------------
                */
                $usersByUsername[$user->username] = $user;

                if (!empty($user->email)) {
                    $usersByEmail[$user->email] = $user;
                }

                /*
                |--------------------------------------------------------------------------
                | Update / buat profile
                |--------------------------------------------------------------------------
                */
                $profileData = [
                    'nik' => $nik,
                    'family_id' => $family->id,
                    'no_hp' =>
                        $row['no_hp']
                        ?? $row['nomor_hp']
                        ?? $row['telepon']
                        ?? null,
                    'alamat' => $row['alamat'] ?? null,
                ];

                if ($profile instanceof WargaProfile) {

                    $profile->update($profileData);

                } else {

                    $profile = WargaProfile::updateOrCreate(
                        ['user_id' => $user->id],
                        $profileData
                    );

                    $profiles[$nik] = $profile;
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Ambil golongan 1 / 2 / 3
    |--------------------------------------------------------------------------
    */
    private function golongan(mixed $value): ?int
    {
        preg_match(
            '/[123]/',
            (string) $value,
            $matches
        );

        return isset($matches[0])
            ? (int) $matches[0]
            : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Buat username tanpa query database berulang
    |--------------------------------------------------------------------------
    */
    private function makeUsername(
        string $nama,
        Collection $users
    ): string {

        $base = Str::slug($nama, '') ?: 'warga';

        $username = $base;
        $number = 1;

        while ($users->has($username)) {

            $username = $base . $number;

            $number++;
        }

        return $username;
    }

    /*
    |--------------------------------------------------------------------------
    | Buat email tanpa query database berulang
    |--------------------------------------------------------------------------
    */
    private function makeEmail(
        string $username,
        Collection $emails
    ): string {

        $base = Str::slug(
            $username,
            '.'
        ) ?: 'warga';

        $email = $base . '@warga.local';

        $number = 1;

        while ($emails->has($email)) {

            $email = $base
                . $number
                . '@warga.local';

            $number++;
        }

        return $email;
    }
}
