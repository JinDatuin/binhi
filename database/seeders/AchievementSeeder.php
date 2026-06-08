<?php

namespace Database\Seeders;

use App\Models\AchievementLevel;
use App\Models\AchievementPlacement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            ['level' => 'School-Based', 'points' => 0.25],
            ['level' => 'Barangay',      'points' => 0.50],
            ['level' => 'Municipal',     'points' => 1],
            ['level' => 'Provincial',    'points' => 2],
            ['level' => 'Regional',      'points' => 5],
            ['level' => 'National',      'points' => 10],
            ['level' => 'International', 'points' => 15],
        ];

        foreach ($levels as $level) {
            AchievementLevel::firstOrCreate(
                ['level' => $level['level']],
                ['points' => $level['points']]
            );
        }

        $placements = [
            ['placement' => '1st',          'multiplier' => 3],
            ['placement' => '2nd',          'multiplier' => 2],
            ['placement' => '3rd',          'multiplier' => 1.5],
            ['placement' => 'Others',       'multiplier' => 1],
            ['placement' => 'Participation','multiplier' => 0.50],
        ];

        foreach ($placements as $placement) {
            AchievementPlacement::firstOrCreate(
                ['placement' => $placement['placement']],
                ['multiplier' => $placement['multiplier']]
            );
        }
    }
}
