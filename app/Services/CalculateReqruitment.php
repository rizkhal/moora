<?php

namespace App\Services;

use App\Models\User;
use App\Models\Criteria;
use App\Models\Reqruitment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CalculateReqruitment
{
    public function execute(Reqruitment $reqruitment)
    {
        $criteria = Criteria::all();

        $query = static::query($reqruitment);

        $grouped = $query->groupBy('user_id');

        // get and map matrix
        $matrix = $grouped->map(function ($object) {
            return $object->map(function ($pariticpan) {
                return $pariticpan->user_criteria_detail_weight;
            });
        });

        // instance Moora Formula
        $formula = new MooraFormula($matrix);

        // calculate divider
        $divider = $formula->divider();

        // calculate normalized
        $normalized = $formula->normalize($divider);

        // calculate optimized
        $optimized = $formula->optimize($criteria->pluck('weight'), $normalized);

        // calculate results
        $result = $formula->result($criteria->pluck('weight_type'), $optimized);

        $users = User::query()->completeRegistration()->participan()->whereHas(
            'reqruitments',
            fn (Builder $query) => $query->whereReqruitmentId($reqruitment->id)
        )->get();

        return compact('users', 'result', 'divider', 'criteria', 'optimized', 'normalized');
    }

    private static function query(Reqruitment $reqruitment): Collection
    {
        return DB::table('users')
            ->selectRaw('users.id as user_id, criteria_details.weight as user_criteria_detail_weight')
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('user_has_criteria_details', 'users.id', '=', 'user_has_criteria_details.user_id')
            ->leftJoin('criteria_details', 'user_has_criteria_details.criteria_detail_id', '=', 'criteria_details.id')
            ->leftJoin('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
            ->leftJoin('user_has_reqruitments', 'users.id', '=', 'user_has_reqruitments.user_id')
            ->where(function (QueryBuilder $query) use ($reqruitment) {
                return $query
                    ->where('roles.name', 'Peserta')
                    ->where('user_details.id', '!=', null)
                    ->where('user_has_reqruitments.reqruitment_id', $reqruitment->id);
            })
            ->get();
    }
}
