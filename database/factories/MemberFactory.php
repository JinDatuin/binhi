<?php

namespace Database\Factories;

use App\Enums\OrganizationalPosition;
use App\Enums\Sex;
use App\Enums\YearSection;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'middle_initial' => strtoupper(fake()->randomLetter()).'.',
            'student_number' => fake()->unique()->numerify('2026-####'),
            'course' => fake()->randomElement(['BS Information Technology', 'BS Computer Science', 'BS Entertainment Computing']),
            'year_section' => fake()->randomElement(YearSection::cases())->value,
            'address_brgy' => fake()->streetName(),
            'address_municipal' => fake()->city(),
            'address_province' => fake()->state(),
            'email_address' => fake()->unique()->safeEmail(),
            'contact_number' => fake()->numerify('09#########'),
            'birthday' => fake()->date(max: '2005-01-01'),
            'sex' => fake()->randomElement(Sex::cases())->value,
            'organizational_position' => fake()->randomElement(OrganizationalPosition::cases())->value,
            'guardian_names' => fake()->name(),
            'guardian_contact_numbers' => fake()->numerify('09#########'),
            'photo' => null,
        ];
    }
}
