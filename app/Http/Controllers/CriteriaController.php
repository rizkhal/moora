<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Enums\CriteriaType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('criteria/index');
    }

    public function create()
    {
        $types = collect(CriteriaType::cases())->mapWithKeys(fn ($item) => [$item->value => Str::title($item->name)]);

        return inertia('criteria/create');
    }
}
