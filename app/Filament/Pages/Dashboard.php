<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('print')
                ->visible(auth()->user()->can('Dashboard.viewPrintable'))
                ->label('Print Report')
                ->icon(Heroicon::OutlinedPrinter)
                ->url(route('print.dashboard'))
                ->openUrlInNewTab()
                ->color('gray'),
        ];
    }
}
