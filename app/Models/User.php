<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\WargaProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    public function wargaProfile()
    {
        return $this->hasOne(WargaProfile::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function kasPayments(): HasMany
    {
        return $this->hasMany(KasPayment::class);
    }
}
