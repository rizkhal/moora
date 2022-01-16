<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use App\Table\UserTable;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request, UserTable $datatable)
    {
        return inertia('user/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
            'roles' => Role::select(['id', 'name'])->where('name', '!=', 'Peserta')->get(),
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->dataUser());
        $user->assignRole(Role::findById($request->role));

        return redirect()->back()->with('success', 'Berhasil menambah pengguna baru');
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->dataUser());
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Berhasil mengubah pengguna');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pengguna');
    }
}
