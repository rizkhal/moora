<?php

namespace App\Table;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleTable
{
    public function columns(): array
    {
        return [
            'name' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'guard' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'tanggal' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'action' => [
                'sortable' => false,
                'searchable' => false,
            ],
        ];
    }

    public function query(Request $request): LengthAwarePaginator
    {
        return Role::query()->paginate(10)->withQueryString()->through(fn ($role) => [
            'id' => $role->id,
            'name' => $role->name,
            'guard' => $role->guard_name,
            'tanggal' => $role->created_at->format('d/m/y')
        ]);;
    }
}
