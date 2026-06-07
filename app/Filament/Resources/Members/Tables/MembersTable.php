<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
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
                TextColumn::make('firstname')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lastname')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student_number')
                    ->label('Student #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('course')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('year_section')
                    ->badge()
                    ->label('Year / Section')
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
