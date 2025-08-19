<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scene extends Model
{
    protected $guarded = ['id'];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
