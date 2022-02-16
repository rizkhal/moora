<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use App\Datatable\UserDatatable;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $roles = Role::select(['id', 'name'])->where('name', '!=', 'Peserta')->get();

        return inertia('user/index')->datatable(new UserDatatable)->with(['roles' => $roles])->title('Daftar Pengguna');
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->dataUser());
        $user->assignRole(Role::findById($request->role));

        return back();
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->dataUser());
        $user->assignRole($request->role);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
