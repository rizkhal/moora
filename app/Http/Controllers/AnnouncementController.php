<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->can('lihat-pengumuman')) {
            abort(403);
        }

        return inertia('announcement/index');
    }
}
