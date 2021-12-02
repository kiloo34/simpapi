<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    // use HasFactory;

    protected $table = 'subkriteria';

    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'kriteria_id'
    ];

    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria');
    }
}
