<?php

namespace App\Datatable;

use App\Models\Criteria;
use App\Datatable\Column;
use App\Datatable\Datatable;
use App\Models\CriteriaDetail;
use Illuminate\Support\Carbon;

class ReqruitmentCriteriaDetailDatatable extends Datatable
{
    public function __construct(
        private Criteria $criteria
    ) {
        # code...
    }

    public function query()
    {
        return CriteriaDetail::query()->whereCriteriaId($this->criteria->id);
    }

    public function columns(): array
    {
        return [
            Column::make('id')->invisible(),
            Column::make('Text', 'text')->sortable()->searchable(),
            Column::make('Bobot', 'weight')->sortable()->searchable(),
            Column::make('Tanggal', 'created_at')->sortable()->searchable()
                ->format(fn (Carbon $value): string => $value->translatedFormat('d F Y')),
            Column::make('Aksi', 'action')
        ];
    }
}
