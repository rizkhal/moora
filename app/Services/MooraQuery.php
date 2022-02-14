<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MooraQuery
{
    public static function query(): Collection
    {
        return DB::table('users')
            ->selectRaw('users.id as user_id, criteria_details.weight as user_criteria_detail_weight')
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('user_has_criteria_details', 'users.id', '=', 'user_has_criteria_details.user_id')
            ->leftJoin('criteria_details', 'user_has_criteria_details.criteria_detail_id', '=', 'criteria_details.id')
            ->leftJoin('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
            ->where(function (QueryBuilder $query) {
                return $query->where('roles.name', 'Peserta')->where('user_details.id', '!=', null);
            })
            ->get();
    }
}
