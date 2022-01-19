<?php

namespace App\Table;

use App\Models\Criteria;
use App\Enums\CriteriaType;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CriteriaTable
{
    public function columns(): array
    {
        return [
            'name' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'allow file upload' => [
                'sortable' => true,
                'searchable' => false,
            ],
            'input type' => [
                'sortable' => true,
                'searchable' => false,
            ],
            'description' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'created_at' => [
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
                'name' => $criteria->name,
                'description' => $criteria->description,
                'input type' => CriteriaType::from($criteria->input_type)->name,
                'allow file upload' => $criteria->allow_file_upload,
                'created_at' => $criteria->created_at->format('d/m/y'),
            ]);
    }
}
