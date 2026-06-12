<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Collection;

class AttendanceRanking extends TableWidget
{
    protected static ?string $heading = 'Attendance Ranking';

    protected int|string|array $columnSpan = 1;

    public function getTableRecords(): Collection
    {
        return Member::query()
            ->withCount('attendances')
            ->get()
            ->sortByDesc(fn ($member) => $member->attendances_count)
            ->values();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rank')
                    ->label('Rank')
                    ->state(fn ($rowLoop) => $rowLoop->iteration)
                    ->sortable(false),
                TextColumn::make('full_name')
                    ->label('Name')
                    ->state(fn (Member $record): string => $record->lastname.', '.$record->firstname.' '.$record->middle_initial)
                    ->searchable(['lastname', 'firstname']),
                TextColumn::make('attendances_count')
                    ->label('Total Present')
                    ->sortable(),
            ])
            ->defaultSort('attendances_count', 'desc');
    }
}
