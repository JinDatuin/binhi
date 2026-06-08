<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LevelsTable;
use App\Filament\Widgets\PlacementsTable;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class Criteria extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Evaluation';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected function getHeaderWidgets(): array
    {
        return [
            LevelsTable::class,
            PlacementsTable::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 2;
    }
}
