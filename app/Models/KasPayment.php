<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasPayment extends Model
{
    use HasFactory;

    public const TARIF_GOLONGAN = [
        1 => 3000,
        2 => 5000,
        3 => 10000,
    ];

    protected $fillable = [
        'user_id',
        'family_id',
        'golongan',
        'nominal',
        'payment_method',
        'bulan',
        'tahun',
        'tanggal_pembayaran',
        'proof_path',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'tanggal_pembayaran' => 'date',
        ];
    }

    public function payer(): BelongsTo
    {
        // Kolom relasi pada tabel memakai nama user_id, bukan payer_id.
        // Menyebutkan foreign key secara eksplisit memastikan nama dan NIK
        // pembayar tampil pada daftar Kas KK maupun laporan keuangan.
        return $this->belongsTo(User::class, 'user_id');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function getNamaGolonganAttribute(): string
    {
        return 'Golongan '.$this->golongan;
    }
}
