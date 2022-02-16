<?php

namespace App\Models;

use App\Models\User;
use App\Jobs\AnnouncementJob;
use App\Enums\AnnouncementStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function booted()
    {
        static::created(function (Announcement $announcement) {
            dispatch(new AnnouncementJob($announcement));
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault(['name' => 'Sistem']);
    }

    public function scopeDefault($query): Builder
    {
        return $query->whereStatus(AnnouncementStatus::DEFAULT->value);
    }

    public function scopeStared($query): Builder
    {
        return $query->whereStatus(AnnouncementStatus::STARED->value);
    }

    public function scopeDraft($query): Builder
    {
        return $query->whereStatus(AnnouncementStatus::DRAFT->value);
    }

    public function scopeFilter($query, $request): Builder
    {
        $reqruitment = $request->get('reqruitments');

        if ($request->has('reqruitments') && $reqruitment != 'all') {
            return $query->whereHas('reqruitments', function (Builder $query) use ($reqruitment) {
                return $query->whereReqruitmentId($reqruitment);
            });
        }

        return $query;
    }

    public function reqruitments(): BelongsToMany
    {
        return $this->belongsToMany(
            Reqruitment::class,
            'announcement_has_reqruitments',
            'announcement_id',
            'reqruitment_id'
        );
    }
}
