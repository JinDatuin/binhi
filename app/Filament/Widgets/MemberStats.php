<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MemberStats extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Member::count();
        $male = Member::where('sex', 'm')->count();
        $female = Member::where('sex', 'f')->count();

        return [
            Stat::make('Total Members', $total)
                ->description('All registered members')
                ->descriptionIcon('heroicon-m-users'),

            Stat::make('Male', $male)
                ->description('Male members')
                ->descriptionIcon('heroicon-m-user'),

            Stat::make('Female', $female)
                ->description('Female members')
                ->descriptionIcon('heroicon-m-user'),
        ];
    }
}
