<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'kode',
        'nama',
        'kriteria_id',
        'subkriteria_id',
        'bobot'
    ];

    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria');
    }

    public function subkriteria()
    {
        return $this->belongsTo('App\Models\Subkriteria');
    }
}
