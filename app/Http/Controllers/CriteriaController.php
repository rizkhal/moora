<?php

namespace App\Http\Controllers;

use App\Constants\Attribute;
use App\Models\Criteria;

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
        $criteria = Criteria::query()->with('sub_criteria')->where('id', $id)->first();
        
        return view('criteria.edit', [
            'row' => $criteria,
            'title' => 'Tambah Kriteria',
            'attributes' => Attribute::labels(),
        ]);
    }
}
