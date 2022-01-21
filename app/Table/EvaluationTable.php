<?php

namespace App\Table;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EvaluationTable
{
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

    public function query(Request $request): LengthAwarePaginator
    {
        return Criteria::query()
            ->paginate(10)->withQueryString()->through(fn ($criteria) => [
                'id' => $criteria->id,
                'nama' => $criteria->name,
                'keterangan' => $criteria->description,
                'upload_file' => $criteria->allow_file_upload,
                'tanggal' => $criteria->created_at->format('d/m/y'),
            ]);
    }
}
