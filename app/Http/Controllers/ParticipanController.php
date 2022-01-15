<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table\ParticipanTable;

class ParticipanController extends Controller
{
    public function index(Request $request, ParticipanTable $datatable)
    {
        return inertia('participan/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }
}
