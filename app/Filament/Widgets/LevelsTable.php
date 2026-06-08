<?php

namespace App\Filament\Widgets;

use App\Models\AchievementLevel;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LevelsTable extends TableWidget
{
    protected static ?string $heading = 'Achievement Levels';

    public function table(Table $table): Table
    {
        return $table
            ->query(AchievementLevel::query())
            ->columns([
                TextColumn::make('level')
                    ->sortable(),
                TextColumn::make('points')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()
                ->visible(auth()->user()->can('Widget.edit'))
                    ->form([
                        TextInput::make('level')->required(),
                        TextInput::make('points')->required()->numeric(),
                    ]),
            ])
            ->toolbarActions([
                CreateAction::make()
                ->visible(auth()->user()->can('Widget.create'))
                    ->form([
                        TextInput::make('level')->required(),
                        TextInput::make('points')->required()->numeric(),
                    ]),
            ]);
    }
}
