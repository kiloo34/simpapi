<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sapi;
use App\User;
use Illuminate\Http\Request;

class PeternakController extends Controller
{
    public function index()
    {
        return view('admin.peternak.index', [
            'title' => 'peternak',
            'subtitle' =>  '',
            'active' => 'peternak',
            'data' => User::where('role_id', 2)->get(),
            'sapi' => Sapi::all()
        ]);
    }
}
