<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peternak extends Model
{
    protected $table = 'peternak';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'alamat',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
