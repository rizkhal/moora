<?php

namespace App\Http\Controllers\Acl;

use App\Table\RoleTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request, RoleTable $datatable)
    {
        return inertia('role/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function create()
    {
        return inertia('role/create', [
            'permissions' => Permission::all(),
        ]);
    }
}
