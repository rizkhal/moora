<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {        
        return view('document.index', [
            'title' => 'Upload Berkas',
            'user' => User::query()->where('id', Auth::id())->firstOrFail(),
            'criteria' => Criteria::query()->with('sub_criteria')->get(),
        ]);
    }
}
