<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrioritasAlternatif extends Model
{
    protected $table = 'prioritas_alternatif';

    protected $fillable = [
        'kode_alt',
        'kode_kri',
        'nilai'
    ];
}
