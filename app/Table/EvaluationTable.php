<?php

namespace App\Table;

use App\Models\User;
use App\Models\Criteria;
use App\Services\MooraQuery;
use App\Services\MooraFormula;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class EvaluationTable
{
    public function execute()
    {
        $query = MooraQuery::query();

        $grouped = $query->groupBy('user_id');
        $matrix = $grouped->map(function ($object) {
            return $object->map(function ($pariticpan) {
                return $pariticpan->user_criteria_detail_weight;
            });
        });

        $criteria = Criteria::all();

        $formula = new MooraFormula($matrix);
        $divider = $formula->divider();
        $normalized = $formula->normalize($divider);
        $optimized = $formula->optimize($criteria->pluck('weight'), $normalized);
        $result = $formula->result($criteria->pluck('weight_type'), $optimized);

        $user = User::whereHas('roles', fn ($query) => $query->whereName('Peserta'))->get();

        return [
            'criteria' => $criteria,
            'divider' => $divider,
            'normalized' => $normalized,
            'user' => $user,
        ];
    }

    public function columns(): array
    {
        return [
            'nama peserta' => [
                'sortable' => true,
                'searchable' => true,
            ],
            'skor' => [
                'sortable' => true,
                'searchable' => false,
            ],
            'rangking' => [
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
