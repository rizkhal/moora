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
        ]);
    }

    public function create()
    {
        return view('criteria.create', [
            'title' => 'Tambah Kriteria',
            'attributes' => Attribute::labels(),
        ]);
    }

    public function edit(string $id)
    {
        return view('criteria.edit', [
            'title' => 'Tambah Kriteria',
            'attributes' => Attribute::labels(),
        ]);
    }
}
