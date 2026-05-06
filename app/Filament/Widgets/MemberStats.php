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

        $active = Member::where('member_status', 'active')->count();

        $inactive = Member::where('member_status', 'inactive')->count();

        return [
            Stat::make('Total Members', $total)
                ->description('All churches')
                ->color('success'),

            Stat::make('Active Members', $active)
                ->description('Currently active')
                ->color('primary'),

            Stat::make('Inactive Members', $inactive)
                ->description('Inactive records')
                ->color('warning'),
        ];
    }
}
