<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\Member;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AttendanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details')
                    ->schema([
                        TextEntry::make('event_name'),
                        TextEntry::make('date')
                            ->date(),
                        TextEntry::make('venue'),
                    ])
                    ->columns(2),
                Section::make('Attendees')
                    ->schema([
                        TextEntry::make('attendees')
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
