<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongans';

    protected $fillable = [
        'company_name',
        'position',
        'location',
        'employment_type',
        'education',
        'experience',
        'category',
        'salary_min',
        'salary_max',
    ];
    
}
