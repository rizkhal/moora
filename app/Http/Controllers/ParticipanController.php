<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Table\ParticipanTable;

class ParticipanController extends Controller
{
    public function index(Request $request, ParticipanTable $datatable): Response
    {
        if (!$request->user()->can('lihat-peserta')) {
            abort(403);
        }

        return inertia('participan/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function show(User $participan)
    {
        return inertia('participan/show');
    }
}
