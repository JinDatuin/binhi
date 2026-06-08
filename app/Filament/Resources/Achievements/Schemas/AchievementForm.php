<?php

namespace App\Filament\Resources\Achievements\Schemas;

use App\Models\Member;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contest')
                    ->required(),
                Select::make('achievement_level_id')
                    ->label('Level')
                    ->relationship('achievementLevel', 'level')
                    ->required(),
                Select::make('achievement_placement_id')
                    ->label('Placement')
                    ->relationship('achievementPlacement', 'placement')
                    ->required(),
                Select::make('members')
                    ->label('Participants')
                    ->relationship('members', 'lastname')
                    ->getOptionLabelFromRecordUsing(fn (Member $record) => "{$record->lastname}, {$record->firstname} {$record->middle_initial}")

                    ->multiple()
                    ->preload(),
            ]);
    }
}
