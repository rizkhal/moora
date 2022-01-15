<?php

namespace App\Http\Controllers\Acl;

use Illuminate\Http\Request;
use App\Table\PermissionTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request, PermissionTable $datatable)
    {
        return inertia('permission/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->validated());
        return redirect()->back()->with('success', 'Berhasil menambah hak akses');
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->update($request->validated());
        return redirect()->back()->with('success', 'Berhasil mengubah hak akses');
    }

    public function destroy(Permission $permission)
    {
        dd($permission);
    }
}
