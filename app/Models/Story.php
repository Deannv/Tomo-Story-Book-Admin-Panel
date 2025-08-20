<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    protected $guarded = ['id'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function storyValues(): HasMany
    {
        return $this->hasMany(StoryValue::class);
    }

    public function scenes(): HasMany
    {
        return $this->hasMany(Scene::class);
    }

    public function comprehensiveQuestions(): HasMany
    {
        return $this->hasMany(ComprehensiveQuestion::class);
    }
}
