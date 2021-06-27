<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function result()
    {
        return view('participan.result', [
            'title' => 'Hasil perhitungan',
            'result' => Result::query()->get(),
        ]);
    }

    public function detail(string $id)
    {
        $users = User::query()->withoutAdmin()->select(['id', 'name'])->get();
        
        return view('participan.result-detail', [
            'title' => 'Hasil perhitungan',
            'users' => $users,
            'criterias' => Criteria::query()->get(),
            'calculated' => Result::query()->whereId($id)->firstOrFail(),
        ]);
    }
}
