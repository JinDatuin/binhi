<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    protected $fillable = [
        'date',
        'event_name',
        'venue',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }
}
