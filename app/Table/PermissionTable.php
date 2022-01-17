<?php

namespace App\Table;

use Illuminate\Http\Request;
use App\Enums\PermissionType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionTable
{
    public function columns(): array
    {
        return [
            'name' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'type' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'description' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'created at' => [
                'sortable' => true,
                'searchable' => true,
            ],
        ];
    }

    public function query(Request $request): LengthAwarePaginator
    {
        return Permission::query()->paginate(10)->withQueryString()->through(fn ($permission) => [
            'id' => $permission->id,
            'name' => $permission->name,
            'type' => PermissionType::from($permission->type)->label(),
            'description' => $permission->description,
            'created at' => $permission->created_at->format('d/m/y')
        ]);;
    }
}
