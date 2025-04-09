<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'mata_pelajaran',
        'tahun_bergabung',
        'nomor_telp',
        'alamat',
        'status',
        'pendidikan_terakhir',
        'jabatan',
        'foto',
    ];
}