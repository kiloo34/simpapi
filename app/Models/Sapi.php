<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    protected $table = 'sapi';

    protected $fillable = [
        'nama',
        'harga_beli',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
