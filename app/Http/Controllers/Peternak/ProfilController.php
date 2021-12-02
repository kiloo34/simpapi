<?php

namespace App\Http\Controllers\Peternak;

use App\Http\Controllers\Controller;
use App\Models\Sapi;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('peternak.profil.index', [
            'title' => 'profil',
            'subtitle' => '',
            'active' => 'profil',
            'sapi' => Sapi::all()
        ]);
    }
}
