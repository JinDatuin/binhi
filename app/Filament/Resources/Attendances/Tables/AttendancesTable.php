<?php

namespace App\Filament\Resources\Attendances\Tables;

use App\Models\Attendance;
use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('event_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('venue')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('attendees')
                    ->label('Attendees')
                    ->getStateUsing(function (Attendance $record): array {
                        return $record->members->map(fn (Member $member) => "{$member->lastname}, {$member->firstname}")->toArray();
                    })
                    ->badge()
                    ->limitList(3)
                    ->expandableLimitedList(),
            ])
            ->filters([
                //
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
