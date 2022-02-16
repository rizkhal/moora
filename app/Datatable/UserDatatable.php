<?php

namespace App\Datatable;

use App\Models\User;
use App\Datatable\Column;
use App\Datatable\Datatable;
use Illuminate\Database\Eloquent\Builder;

class UserDatatable extends Datatable
{
    public function query()
    {
        return User::query()->whereHas('roles', fn (Builder $query): Builder => $query->where('name', '!=', 'Peserta'));
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('role_id')->format(fn ($value, $row) => $row->roles->pluck('id')->first())->invisible(),
            Column::make('Nama', 'name')->sortable()->searchable(),
            Column::make('Email')->sortable()->searchable(),
            Column::make('Role')
                ->format(
                    fn ($value, $row) => $row->roles->pluck('name')->first()
                ),
            Column::make('verified_at')->sortable()->searchable()
                ->format(fn ($value): string => !is_null($value) ? $value->translatedFormat('d F Y') : 'Belum'),
            Column::make('created_at')->sortable()->searchable()
                ->format(fn ($value): string => $value->translatedFormat('d F Y')),
            Column::make('Aksi', 'action')
        ];
    }
}
