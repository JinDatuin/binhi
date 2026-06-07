<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Enums\OrganizationalPosition;
use App\Enums\Sex;
use App\Enums\YearSection;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                            TextInput::make('firstname')->required(),
                            TextInput::make('lastname')->required(),
                            TextInput::make('middle_initial')
                                ->label('Middle Initial'),
                            Select::make('sex')
                                ->required()
                                ->options(Sex::class),
                            DatePicker::make('birthday')
                                ->required(),
                            FileUpload::make('photo')
                                ->label('2x2 Photo')
                                ->image()
                                ->maxSize(1024)
                                ->directory('member-photos')
                                ->visibility('public'),
                        ])
                        ->columns(2),
                    Step::make('Academic Information')
                        ->schema([
                            TextInput::make('student_number')
                                ->required()
                                ->unique(ignoreRecord: true),
                            TextInput::make('course')
                                ->required(),
                            Select::make('year_section')
                                ->label('Year / Section')
                                ->required()
                                ->options(YearSection::class),
                            Select::make('organizational_position')
                                ->label('Organizational Position')
                                ->required()
                                ->options(OrganizationalPosition::class),
                        ])
                        ->columns(2),
                    Step::make('Contact & Guardian')
                        ->schema([
                            TextInput::make('email_address')
                                ->label('Email Address')
                                ->required()
                                ->email(),
                            TextInput::make('contact_number')
                                ->label('Contact Number')
                                ->required(),
                            TextInput::make('address_brgy')
                                ->label('Barangay')
                                ->required(),
                            TextInput::make('address_municipal')
                                ->label('Municipal')
                                ->required(),
                            TextInput::make('address_province')
                                ->label('Province')
                                ->required(),
                            TextInput::make('guardian_names')
                                ->label("Parent's / Guardian's Names")
                                ->required(),
                            TextInput::make('guardian_contact_numbers')
                                ->label('Guardian Contact Numbers')
                                ->required(),
                        ])
                        ->columns(2)])
                    ->columnSpanFull(),
            ]);
    }
}
