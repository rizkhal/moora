<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
