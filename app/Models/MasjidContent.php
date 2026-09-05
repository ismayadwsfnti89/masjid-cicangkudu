<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasjidContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'image_path',
        'event_date',
        'amount',
        'transaction_type',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function donations(): HasMany { return $this->hasMany(Donation::class); }
}
