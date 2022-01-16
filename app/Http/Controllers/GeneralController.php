<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class GeneralController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('setting/general');
    }
}
