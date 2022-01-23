<?php

namespace App\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MooraQuery
{
    public static function query(): Collection
    {
        return DB::table('users')
            ->selectRaw('
                users.id as user_id, users.name as user_name,
                user_details.nik as user_nik,
                user_details.picture as user_picture,
                user_has_criteria_details.file as user_criteria_file,
                criterias.name as user_criteria_name,
                criterias.weight as user_criteria_weight,
                criterias.weight_type as user_criteria_weight_type,
                criteria_details.id as user_criteria_detail_id,
                criteria_details.text as user_criteria_detail_text,
                criteria_details.weight as user_criteria_detail_weight
            ')
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')

            ->leftJoin('user_has_criteria_details', 'users.id', '=', 'user_has_criteria_details.user_id')
            ->leftJoin('criteria_details', 'user_has_criteria_details.criteria_detail_id', '=', 'criteria_details.id')
            ->leftJoin('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
            ->where(function (Builder $query) {
                return $query->where('roles.name', 'Peserta')->where('user_details.id', '!=', null);
            })
            ->get();
    }
}
