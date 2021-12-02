<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganSubkriteria extends Model
{
    protected $table = 'perbandingan_subkriteria';

    protected $fillable = [
        'subkriteria_id1',
        'subkriteria_id2',
        'nilai'
    ];
}
