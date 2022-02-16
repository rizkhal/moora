<?php

namespace App\Http\Controllers\Acl;

use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use App\Datatable\Acl\PermissionDatatable;

class PermissionController extends Controller
{
    public function index(): Response
    {
        return inertia('permission/index')
            ->datatable(new PermissionDatatable)
            ->title('Daftar Permission');
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->validated());
        return back();
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->update($request->validated());
        return back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }
}
