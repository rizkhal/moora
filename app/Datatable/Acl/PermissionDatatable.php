<?php

namespace App\Datatable\Acl;

use App\Datatable\Column;
use App\Datatable\Datatable;
use App\Enums\PermissionType;
use Spatie\Permission\Models\Permission;

class PermissionDatatable extends Datatable
{
    public function query()
    {
        return Permission::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Nama', 'name')->sortable()->searchable(),
            Column::make('Tipe', 'type')->sortable()->searchable()
                ->format(fn ($value) => PermissionType::tryFrom($value)->label()),
            Column::make('Keterangan', 'description')->sortable()->searchable(),
            Column::make('Tanggal', 'created_at')->sortable()->searchable()
                ->format(fn ($value): string => $value->format('d/m/Y')),
        ];
    }
}
