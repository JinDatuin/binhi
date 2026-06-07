<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Member Profile')
                    ->schema([
                        ImageEntry::make('photo')
                            ->circular()
                            ->visibility('public')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->alignCenter(),
                        TextEntry::make('full_name')
                            ->label('Name')
                            ->state(fn ($record) => trim(
                                "{$record->firstname} {$record->middle_initial} {$record->lastname}"
                            )),

                        TextEntry::make('sex'),

                        TextEntry::make('birthday')
                            ->date(),
                    ])
                    ->columns(2),

                Section::make('Academic Information')
                    ->schema([
                        TextEntry::make('student_number'),

                        TextEntry::make('course'),

                        TextEntry::make('year'),

                        TextEntry::make('section'),

                        TextEntry::make('organizational_position')
                            ->badge(),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextEntry::make('email_address'),

                        TextEntry::make('contact_number'),

                        TextEntry::make('address_brgy')
                            ->label('Barangay'),

                        TextEntry::make('address_municipal')
                            ->label('Municipal'),

                        TextEntry::make('address_province')
                            ->label('Province'),
                    ])
                    ->columns(2),

                Section::make('Guardian Information')
                    ->schema([
                        TextEntry::make('guardian_names')
                            ->label("Parent's / Guardian's Names"),

                        TextEntry::make('guardian_contact_numbers')
                            ->label('Guardian Contact Numbers'),
                    ])
                    ->columns(2),
            ]);
    }
}
