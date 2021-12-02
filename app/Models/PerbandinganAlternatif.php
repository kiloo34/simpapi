<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganAlternatif extends Model
{
    protected $table = 'perbandingan_alternatif';

    protected $fillable = [
        'alternatif_id1',
        'alternatif_id2',
        'nilai',
        'kode'
    ];
}
