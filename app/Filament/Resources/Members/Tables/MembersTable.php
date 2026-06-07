<?php

namespace App\Filament\Resources\Members\Tables;

use App\Enums\OrganizationalPosition;
use App\Enums\Year;
use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=N%2FA&background=gray&color=fff'),
                TextColumn::make('student_number')
                    ->label('Student #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->state(fn ($record) => trim(
                        "{$record->lastname}, {$record->firstname} {$record->middle_initial}"
                    ))
                    ->searchable(['firstname', 'lastname'])
                    ->sortable(),
                TextColumn::make('course')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('yearAndSection')
                    ->label('Year & Section')
                    ->state(fn ($record) => "{$record->year->getLabel()} - {$record->section}")
                    ->sortable(),
                TextColumn::make('organizational_position')
                    ->badge()
                    ->label('Position')
                    ->sortable(),
                TextColumn::make('email_address')
                    ->label('Email')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contact_number')
                    ->label('Contact')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('course')
                    ->options(
                        Member::distinct()->pluck('course', 'course')->toArray()
                    ),
                SelectFilter::make('year')
                    ->options(Year::class),
                SelectFilter::make('organizational_position')
                    ->label('Position')
                    ->options(OrganizationalPosition::class),
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
