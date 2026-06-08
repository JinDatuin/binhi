<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementLevel extends Model
{
    protected $fillable = [
        'level',
        'points',
    ];
}
