<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criteria extends Model
{
    protected $guarded = [];

    protected $casts = [
        'weight' => 'float',
        'weight_type' => 'integer',
        'allow_file_upload' => 'boolean'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function details(): HasMany
    {
        return $this->hasMany(CriteriaDetail::class, 'criteria_id');
    }
}
