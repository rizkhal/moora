<?php

namespace App\Http\Controllers\Acl;

use App\Table\RoleTable;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

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
            'permissions' => Permission::select(['id', 'name', 'type'])->get()->groupBy('type')->all(),
        ]);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->role());
        $role->syncPermissions($request->permissions());

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->back()->with('success', 'Berhasil menambah role');
    }

    public function show(Role $role)
    {
        return inertia('role/create', [
            'role' => $role,
            'permissions' => Permission::select(['id', 'name', 'type'])->get()->groupBy('type')->all(),
            'permissionSelected' => $role->permissions()->select(['id', 'name', 'type'])->get()->groupBy('type')->all(),
        ]);
    }

    public function update(Role $role, RoleRequest $request)
    {
        $role->update($request->role());
        $role->syncPermissions($request->permissions());
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->back()->with('success', 'Berhasil mengubah role');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        return redirect()->back()->with('success', 'Berhasil menghapus role');
    }
}
