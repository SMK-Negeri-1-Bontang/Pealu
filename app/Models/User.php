<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable // <== Perbaikan di sini
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nama_lengkap',
        'hp',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function isAdmin()
    {
        return $this->hasRole()->where('role', 'admin')->exists();
    }

    public function isUser()
    {
        return $this->hasRole()->where('role', 'user')->exists();
    }
}
