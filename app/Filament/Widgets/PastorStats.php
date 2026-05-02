<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PastorStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pastors', \App\Models\Pastor::count())
                ->description('Total pastors registered')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('Ordained Pastors', \App\Models\Pastor::where('type', 'ordained')->count())
                ->description('Ordained ministers')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Licensed Pastors', \App\Models\Pastor::where('type', 'district_licensed')->count())
                ->description('District licensed')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning'),

            Stat::make('Local Pastors', \App\Models\Pastor::where('type', 'local_pastor')->count())
                ->description('Local licensed pastors')
                ->descriptionIcon('heroicon-m-home')
                ->color('info'),
        ];
    }
}
