<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MemberStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Members', Member::count())
                ->color('success'),

            Stat::make('Active Members', Member::where('member_status', 'active')->count())
                ->color('primary'),

            Stat::make('Inactive Members', Member::where('member_status', 'inactive')->count())
                ->color('warning'),
        ];
    }
}
