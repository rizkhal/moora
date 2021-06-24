<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Criteria;

class ParticipanController extends Controller
{
    public function index()
    {
        return view('participan.index', [
            'title' => 'Daftar Peserta',
            'criterias' => Criteria::query()->select(['id', 'code', 'name'])->get(),
        ]);
    }

    public function detail(string $id)
    {
        dd($id, 'asw');
    }

    public function result()
    {
        return view('participan.result', [
            'title' => 'Hasil perhitungan',
            'result' => Result::query()->get(),
        ]);
    }
}
