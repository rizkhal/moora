<?php

namespace App\Models;

use App\Models\User;
use App\Models\Criteria;
use App\Enums\ReqruitmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reqruitment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_at' => 'date:Y-m-d',
        'end_at' => 'date:Y-m-d',
    ];

    public function criterias(): HasMany
    {
        return $this->hasMany(Criteria::class, 'reqruitment_id', 'id');
    }

    public function scopeActive(): Builder
    {
        return static::whereStatus(ReqruitmentStatus::OPEN->value);
    }

    public function scopeClosed(): Builder
    {
        return static::whereStatus(ReqruitmentStatus::CLOSED->value);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_has_reqruitments',
            'reqruitment_id',
            'user_id'
        );
    }

    public function announcements(): BelongsToMany
    {
        return $this->belongsToMany(
            Announcement::class,
            'announcement_has_reqruitments',
            'reqruitment_id',
            'announcement_id'
        );
    }
}
