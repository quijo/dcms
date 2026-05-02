<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class MemberStats extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        $churchId = $user?->church_id ?: $user?->effective_church_id;

        if (!$churchId) {
            return [
                Stat::make('Total Members', '0')
                    ->description('No church assigned')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('gray'),
            ];
        }

        $members = Member::where('church_id', $churchId);

        return [
            Stat::make('Total Members', $members->count())
                ->description('Members in your church')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Active Members', $members->where('member_status', 'active')->count())
                ->description('Currently active members')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Inactive Members', $members->where('member_status', 'inactive')->count())
                ->description('Inactive member records')
                ->descriptionIcon('heroicon-m-user-minus')
                ->color('warning'),
        ];
    }
}
