<?php

namespace App\Http\Controllers;

use App\Constants\Attribute;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        return view('criteria.index', [
            'title' => 'Daftar Kriteria',
            'attributes' => Attribute::labels(),
        ]);
    }
}
