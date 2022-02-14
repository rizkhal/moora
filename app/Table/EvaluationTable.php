<?php

namespace App\Table;

use App\Models\User;
use App\Models\Criteria;
use App\Services\MooraQuery;
use App\Services\MooraFormula;

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
        $users = User::whereHas('roles', fn ($query) => $query->whereName('Peserta'))->get();

        return compact('users', 'result', 'divider', 'criteria', 'optimized', 'normalized');
    }
}
