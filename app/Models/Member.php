<?php

namespace App\Models;

use App\Enums\OrganizationalPosition;
use App\Enums\Sex;
use App\Enums\YearSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'year_section',
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
            'year_section' => YearSection::class,
            'organizational_position' => OrganizationalPosition::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
