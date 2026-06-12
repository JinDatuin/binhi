<?php

namespace App\Filament\Widgets;

use App\Models\AchievementPlacement;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PlacementsTable extends TableWidget
{
    protected static ?string $heading = 'Achievement Placements';

    public function table(Table $table): Table
    {
        return $table
            ->query(AchievementPlacement::query())
            ->columns([
                TextColumn::make('placement')
                    ->sortable(),
                TextColumn::make('multiplier')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(auth()->user()->can('Widget.edit'))

                    ->form([
                        TextInput::make('placement')->required(),
                        TextInput::make('multiplier')->required()->numeric(),
                    ]),
            ])
            ->toolbarActions([
                CreateAction::make()
                    ->visible(auth()->user()->can('Widget.create'))

                    ->form([
                        TextInput::make('placement')->required(),
                        TextInput::make('multiplier')->required()->numeric(),
                    ]),
            ]);
    }
}
