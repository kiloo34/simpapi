<?php

namespace App\Http\Controllers\Peternak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('peternak.dashboard', [
            'title' => 'dashboard',
            'subtitle' => '',
            'active' => 'dashboard'
        ]);
    }
}
