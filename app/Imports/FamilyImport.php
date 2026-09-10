<?php

namespace App\Imports;

use App\Models\Family;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FamilyImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $index => $row) {
                $baris = $index + 2;
                $noKk = strtoupper(trim((string) ($row['no_kk'] ?? $row['nomor_kk'] ?? '')));
                preg_match('/[123]/', (string) ($row['golongan'] ?? ''), $matches);
                $golongan = isset($matches[0]) ? (int) $matches[0] : null;

                if ($noKk === '') {
                    continue;
                }
                if (! $golongan) {
                    throw ValidationException::withMessages(['file' => "Baris {$baris}: golongan wajib diisi 1, 2, atau 3."]);
                }

                $family = Family::where('no_kk', $noKk)->first();
                if ($family && $family->golongan !== $golongan) {
                    throw ValidationException::withMessages(['file' => "Baris {$baris}: golongan KK {$noKk} berbeda dari data yang sudah ada."]);
                }
                if (! $family) {
                    if (Family::count() >= 100) {
                        throw ValidationException::withMessages(['file' => 'Batas maksimal 100 KK telah tercapai.']);
                    }
                    Family::create(['no_kk' => $noKk, 'golongan' => $golongan]);
                }
            }
        });
    }
}
