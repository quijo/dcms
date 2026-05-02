<?php

namespace App\Filament\Widgets;

use App\Models\Church;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ChurchStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Registered Churches', Church::count())
                ->description('All registered churches')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('primary')
                ->icon('heroicon-o-building-office'),
            Stat::make('Active Churches', \App\Models\Church::where('status', 'active')->count())
                ->description('Currently active churches')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Inactive Churches', \App\Models\Church::where('status', 'inactive')->count())
                ->description('Inactive or closed churches')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),

            Stat::make('Organized Churches', \App\Models\Church::where('type', 'organized')->count())
                ->description('Fully organized churches')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->icon('heroicon-o-building-library'),

            Stat::make('Mission Churches', \App\Models\Church::where('type', 'mission')->count())
                ->description('Mission church plants')
                ->descriptionIcon('heroicon-m-rocket-launch')
                ->color('warning')
                ->icon('heroicon-o-rocket-launch'),

        ];
    }
}
