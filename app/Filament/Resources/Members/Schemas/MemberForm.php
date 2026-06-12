<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Enums\OrganizationalPosition;
use App\Enums\Sex;
use App\Enums\Year;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Personal Information')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('lastname')->required()
                                        ->label('Last Name'),
                                    TextInput::make('firstname')->required()
                                        ->label('First Name'),
                                    TextInput::make('middle_initial')
                                        ->label('Middle Initial'),
                                ]),
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('email_address')
                                        ->label('Email Address')
                                        ->required()
                                        ->email(),
                                    Select::make('sex')
                                        ->required()
                                        ->options(Sex::class),
                                    DatePicker::make('birthday'),
                                    FileUpload::make('photo')
                                        ->label('2x2 Photo')
                                        ->image()
                                        ->maxSize(1024)
                                        ->directory('member-photos')
                                        ->visibility('public'),
                                ]),
                        ]),
                    Step::make('Academic Information')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('student_number')
                                        ->required()
                                        ->unique(ignoreRecord: true),
                                    Select::make('organizational_position')
                                        ->label('Organizational Position')
                                        ->required()
                                        ->options(OrganizationalPosition::class),
                                ]),
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('course')
                                        ->required(),
                                    Select::make('year')
                                        ->label('Year')
                                        ->required()
                                        ->options(Year::class),
                                    TextInput::make('section')
                                        ->label('Section'),
                                ]),

                        ]),
                    Step::make('Contact & Guardian')
                        ->schema([
                            TextInput::make('address_brgy')
                                ->label('Barangay'),
                            TextInput::make('address_municipal')
                                ->label('Municipal'),
                            TextInput::make('address_province')
                                ->label('Province'),
                            TextInput::make('contact_number')
                                ->label('Contact Number'),
                            TextInput::make('guardian_names')
                                ->label("Parent's / Guardian's Names"),
                            TextInput::make('guardian_contact_numbers')
                                ->label('Guardian Contact Numbers'),
                        ])
                        ->columns(3)])
                    ->columnSpanFull(),
            ]);
    }
}
