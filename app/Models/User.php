<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeParticipan($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', '<>', 'Admin');
        });
    }

    public function avatar(): Attribute
    {
        return new Attribute(
            get: fn (string|null $value) => "https://ui-avatars.com/api/?name={$this->name}&amp;color=FFFFFF&amp;background=111827",
        );
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'id', 'user_id');
    }
}
