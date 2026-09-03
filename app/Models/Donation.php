<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = ['user_id', 'masjid_content_id', 'amount', 'payment_method', 'proof_path', 'status'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function program(): BelongsTo { return $this->belongsTo(MasjidContent::class, 'masjid_content_id'); }
}
