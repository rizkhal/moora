<?php

namespace App\Table;

use App\Models\Criteria;
use App\Enums\WeightType;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CriteriaTable
{
    public function query(Request $request): LengthAwarePaginator
    {
        return Criteria::query()
            ->paginate(10)->withQueryString()->through(fn ($criteria) => [
                'id' => $criteria->id,
                'nama' => $criteria->name,
                'bobot' => $criteria->weight,
                'total_option' => $criteria->details->count(),
                'keterangan' => $criteria->description,
                'upload_file' => $criteria->allow_file_upload,
                'tanggal' => $criteria->created_at->format('d/m/y'),
                'jenis_bobot' => WeightType::from($criteria->weight_type)->name,
            ]);
    }

    public function columns(): array
    {
        return [
            'nama' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'upload_file' => [
                'sortable' => true,
                'searchable' => false,
            ],
            'bobot' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'jenis_bobot' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'total_option' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'keterangan' => [
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
}
