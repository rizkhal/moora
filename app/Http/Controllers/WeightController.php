<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        return view('weight.index', [
            'title' => 'Daftar Bobot'
        ]);
    }
}
