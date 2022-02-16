<?php

namespace App\Datatable;

use App\Datatable\Column;
use App\Datatable\Datatable;
use App\Enums\ReqruitmentStatus;
use App\Models\Reqruitment;

class ReqruitmentDatatable extends Datatable
{
    public function query()
    {
        return Reqruitment::query()->withCount(['criterias', 'users']);
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Nama Penerimaan', 'name')->sortable()->searchable(),
            Column::make('Nilai Min Kelulusan', 'min_pass')->sortable()->searchable(),
            Column::make('Jumlah Kriteria', 'criterias_count')->sortable(),
            Column::make('Jumlah Peserta', 'users_count')->sortable(),
            Column::make('Tanggal Mulai', 'start_at')->sortable()->searchable()
                ->format(fn ($value): string => $value->translatedFormat('d F Y')),
            Column::make('Tanggal Selesai', 'end_at')->sortable()->searchable()
                ->format(fn ($value): string => $value->translatedFormat('d F Y')),
            Column::make('Status', 'status')->sortable()
                ->format(fn ($value): string => ReqruitmentStatus::tryFrom($value)->label()),
            Column::make('Keterangan', 'description')->sortable()->searchable(),
            Column::make('Aksi', 'action')
        ];
    }
}
