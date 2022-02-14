<?php

namespace App\Datatable\Acl;

use App\Datatable\Column;
use App\Datatable\Datatable;
use Spatie\Permission\Models\Role;

class RoleDatatable extends Datatable
{
    public function query()
    {
        return Role::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Nama Role', 'name')->sortable()->searchable(),
            Column::make('Guard', 'guard_name')->sortable()->searchable(),
            Column::make('Keterangan', 'description')->sortable()->searchable(),
            Column::make('Tanggal', 'created_at')->sortable()->searchable()->format(fn ($value) => $value->format('d/m/Y')),
            Column::make('Aksi', 'action')
        ];
    }
}
