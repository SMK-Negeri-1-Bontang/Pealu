<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nama_lengkap',
        'hp',
        'email',
        'password',
        'role', // Pastikan kolom role ada di database users
        'image'
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

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah user biasa.
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
    /**
     * Cek apakah user adalah petugas.
     */
    public function isPetugas() {
        return $this->role === 'petugas';
    }
}
