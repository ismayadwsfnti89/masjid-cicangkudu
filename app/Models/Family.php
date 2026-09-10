<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use HasFactory;

    public const TARIF_GOLONGAN = [1 => 3000, 2 => 5000, 3 => 10000];

    protected $fillable = ['no_kk', 'golongan'];

    public function members(): HasMany
    {
        return $this->hasMany(WargaProfile::class);
    }

    public function kasPayments(): HasMany
    {
        return $this->hasMany(KasPayment::class);
    }

    public function getNominalKasAttribute(): int
    {
        return self::TARIF_GOLONGAN[$this->golongan];
    }
}
