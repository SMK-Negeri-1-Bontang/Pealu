<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahBerita extends Model
{
    use HasFactory;

    protected $table = 'tambahberita';

    protected $fillable = [
        'title',
        'content',
        'image',
    ];
}
