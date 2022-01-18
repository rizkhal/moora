<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

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
        'avatar' => 'string',
        'email_verified_at' => 'datetime',
    ];

    public function scopeParticipan($query)
    {
        return $query->whereHas('roles', fn (Builder $query) => $query->where('name', 'Peserta'));
    }

    public function scopeUser($query)
    {
        return $query->whereHas('roles', fn (Builder $query) => $query->where('name', '!=', 'Peserta'));
    }

    public function avatar(): Attribute
    {
        return new Attribute(
            get: fn (string|null $value) => "https://ui-avatars.com/api/?name={$this->name}&amp;color=FFFFFF&amp;background=111827",
        );
    }

    public function detail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }
}
