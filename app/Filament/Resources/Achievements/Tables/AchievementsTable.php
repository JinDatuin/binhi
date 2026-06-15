<?php

namespace App\Filament\Resources\Achievements\Tables;

use App\Models\Achievement;
use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contest')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('achievementLevel.level')
                    ->label('Level')
                    ->sortable(),
                TextColumn::make('achievementPlacement.placement')
                    ->label('Placement')
                    ->sortable(),
                TextColumn::make('members_count')
                    ->visible(auth()->user()->can('Achievement.viewParticipants'))
                    ->label('Participants')
                    ->getStateUsing(function (Achievement $record): array {
                        return $record->members->map(fn (Member $member) => "{$member->lastname}, {$member->firstname}")->toArray();
                    })
                    ->badge()
                    ->limitList(3)
                    ->expandableLimitedList(),
            ])
            ->filters([
                SelectFilter::make('achievement_level_id')
                    ->label('Level')
                    ->relationship('achievementLevel', 'level'),
                SelectFilter::make('achievement_placement_id')
                    ->label('Placement')
                    ->relationship('achievementPlacement', 'placement'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
