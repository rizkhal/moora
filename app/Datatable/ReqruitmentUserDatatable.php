<?php

namespace App\Datatable;

use App\Models\User;
use App\Datatable\Column;
use App\Models\Reqruitment;
use App\Datatable\Datatable;
use Illuminate\Database\Eloquent\Builder;

class ReqruitmentUserDatatable extends Datatable
{
    public function __construct(
        private Reqruitment $reqruitment
    ) {
        # code...
    }

    public function query()
    {
        return User::query()
            ->with('detail')->whereHas(
                'reqruitments',
                fn (Builder $query) => $query->whereId($this->reqruitment->id)
            );
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Nama Peserta', 'name')->sortable()->searchable(),
            Column::make('Email', 'email')->searchable()->sortable(),
            Column::make('Tgl Verifikasi Email', 'email_verified_at')->searchable()->sortable()
                ->format(fn ($value): string => $value ? $value->translatedFormat('d F Y') : 'Belum'),
            Column::make('Tgl Pendaftaran', 'created_at')->searchable()->sortable()
                ->format(fn ($value): string => $value->translatedFormat('d F Y')),
            Column::make('Berkas')->format(fn ($value, $row): string => is_null($row->detail) ? 'Belum' : 'Sudah')
        ];
    }
}
