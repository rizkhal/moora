<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaDetail extends Model
{
    protected $guarded = [];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'id');
    }
}
