<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Table\ParticipanTable;

class ParticipanController extends Controller
{
    public function index(Request $request, ParticipanTable $datatable)
    {
        if (!$request->user()->can('lihat-peserta')) {
            abort(403);
        }

        return inertia('participan/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function verification(): Response
    {
        return inertia('participan/verification');
    }
}
