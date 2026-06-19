<?php

namespace App\Models;

use App\Enums\OrganizationalPosition;
use App\Enums\Sex;
use App\Enums\Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Schoolees\Psgc\Models\Barangay;
use Schoolees\Psgc\Models\City;
use Schoolees\Psgc\Models\Province;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'middle_initial',
        'student_number',
        'course',
        'year',
        'section',
        'address_brgy',
        'address_municipal',
        'address_province',
        'email_address',
        'contact_number',
        'birthday',
        'sex',
        'organizational_position',
        'guardian_names',
        'guardian_contact_numbers',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'sex' => Sex::class,
            'year' => Year::class,
            'organizational_position' => OrganizationalPosition::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendances(): BelongsToMany
    {
        return $this->belongsToMany(Attendance::class);
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class);
    }

    public function getAchievementPointsAttribute(): float
    {
        return $this->achievements->sum(
            fn ($achievement) => $achievement->achievementLevel->points
                * $achievement->achievementPlacement->multiplier
        );
    }

    public function getProvinceNameAttribute(): ?string
    {
        return Province::find($this->address_province)?->name;
    }

    public function getMunicipalityNameAttribute(): ?string
    {
        return City::find($this->address_municipal)?->name;
    }

    public function getBarangayNameAttribute(): ?string
    {
        return Barangay::find($this->address_brgy)?->name;
    }
}
