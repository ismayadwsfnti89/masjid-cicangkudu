<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\WargaProfile;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'no_hp',    // <-- Pastikan baris ini ada
        'alamat',   // <-- Pastikan baris ini ada
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    public function wargaProfile()
    {
        return $this->hasOne(WargaProfile::class);
    }
}