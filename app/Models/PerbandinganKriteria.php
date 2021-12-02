<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganKriteria extends Model
{
    protected $table = 'perbandingan_kriteria';

    protected $fillable = [
        'kriteria_id1',
        'kriteria_id2',
        'nilai'
    ];
}
