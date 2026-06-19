<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        DatePicker::make('date')
                            ->required(),
                        TextInput::make('event_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('venue')
                            ->required()
                            ->maxLength(255),
                    ])->columnSpanFull(),
                Select::make('members')
                    ->multiple()
                    ->relationship('members', 'lastname')
                    ->getOptionLabelFromRecordUsing(fn (Member $record) => "{$record->lastname}, {$record->firstname} {$record->middle_initial}")
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
            ]);
    }
}
