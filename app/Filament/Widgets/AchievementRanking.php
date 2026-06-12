<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Collection;

class AchievementRanking extends TableWidget
{
    protected static ?string $heading = 'Achievement Ranking';

    protected int|string|array $columnSpan = 1;

    public function getTableRecords(): Collection
    {
        return Member::query()
            ->with([
                'achievements.achievementLevel',
                'achievements.achievementPlacement',
            ])
            ->get()
            ->sortByDesc(fn ($member) => $member->achievement_points)
            ->values();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rank')
                    ->rowIndex(),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->state(fn (Member $record) => "{$record->lastname}, {$record->firstname} {$record->middle_initial}")
                    ->searchable(['lastname', 'firstname']),
                TextColumn::make('achievement_points')
                    ->label('Total Score'),
            ]);
    }
}
