<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;
use App\Table\EvaluationTable;

class EvaluationController extends Controller
{
    public function index(Request $request, EvaluationTable $datatable): Response
    {
        return inertia('evaluation/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }
}
