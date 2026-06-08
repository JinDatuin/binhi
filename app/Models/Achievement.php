<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    protected $fillable = [
        'contest',
        'achievement_level_id',
        'achievement_placement_id',
    ];

    public function achievementLevel(): BelongsTo
    {
        return $this->belongsTo(AchievementLevel::class);
    }

    public function achievementPlacement(): BelongsTo
    {
        return $this->belongsTo(AchievementPlacement::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)
            ->using(Participant::class)
            ->withTimestamps();
    }
}
