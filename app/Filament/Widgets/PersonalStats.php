<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PersonalStats extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->hasRole('member');
    }
    protected function getStats(): array
    {
        $totalAttendance = Attendance::count();

        return [
            Stat::make('Total Attendance', $totalAttendance)
                ->description('Your Overall Attendance')
                ->descriptionIcon('heroicon-m-calendar'),
        ];
    }
}
