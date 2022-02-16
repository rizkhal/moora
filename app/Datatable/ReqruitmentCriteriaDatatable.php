<?php

namespace App\Datatable;

use App\Models\Criteria;
use App\Datatable\Column;
use App\Models\Reqruitment;
use App\Datatable\Datatable;

class ReqruitmentCriteriaDatatable extends Datatable
{
    public function __construct(
        private Reqruitment $reqruitment
    ) {
        # code...
    }

    public function query()
    {
        return Criteria::query()->withCount('details')->whereReqruitmentId($this->reqruitment->id);
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Nama', 'name')->sortable()->searchable(),
            Column::make('File Upload', 'allow_file_upload')->sortable()->searchable(),
            Column::make('Bobot', 'weight')->sortable()->searchable(),
            Column::make('Jenis Bobot', 'weight_type')->sortable()->searchable(),
            Column::make('Jumlah Pilihan', 'details_count')->sortable(),
            Column::make('Keterangan', 'description')->sortable()->searchable(),
            Column::make('Aksi', 'action')
        ];
    }
}
