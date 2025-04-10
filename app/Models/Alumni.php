<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumnis';

    protected $fillable = [
        'nis',
        'nama_lengk',
        'jur_sekolah',
        'tahun_lulus',
        'nomor_telp',
        'alamat_rum',
        'wirausaha',
        'status',
        'nama_per',
        'nama_tok',
        'lok_bekerja',
        'jalur',
        'nama_perti',
        'jur_prodi',
        'lok_kuliah',
        'image',
    ];
}
