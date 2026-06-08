<?php

namespace App\Filament\Resources\Achievements\Schemas;

use App\Models\Member;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AchievementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Achievement Details')
                    ->schema([
                        TextEntry::make('contest'),
                        TextEntry::make('achievementLevel.level')
                            ->label('Level'),
                        TextEntry::make('achievementPlacement.placement')
                            ->label('Placement'),
                    ])
                    ->columns(2),

                Section::make('Participants')
                    ->schema([
                        TextEntry::make('members')
                            ->label('Members')
                            ->getStateUsing(function ($record): array {
                                return $record->members->map(fn (Member $member) => trim(
                                    "{$member->lastname}, {$member->firstname} {$member->middle_initial}"
                                ))->toArray();
                            })
                            ->badge()
                            ->limitList(5)
                            ->expandableLimitedList(),
                    ]),
            ]);
    }
}
