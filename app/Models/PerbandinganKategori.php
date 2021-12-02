<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganKategori extends Model
{
    protected $table = 'perbandingan_kategori';

    protected $fillable = [
        'kategori_id1',
        'kategori_id2',
        'nilai',
        'kode'
    ];
}
