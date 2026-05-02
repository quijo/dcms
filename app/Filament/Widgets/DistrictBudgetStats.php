<?php

namespace App\Filament\Widgets;

use App\Models\Giving;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DistrictBudgetStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        if ($user?->hasRole('super-admin')) {
            $givings = Giving::query();
            $label = 'All Churches';
        } else {
            $churchId = $user?->church_id ?: $user?->effective_church_id;

            if (!$churchId) {
                return [
                    Stat::make('Total Givings', '0')
                        ->description('No church assigned')
                        ->descriptionIcon('heroicon-m-currency-dollar')
                        ->color('gray'),
                ];
            }

            $givings = Giving::where('church_id', $churchId);
            $label = 'Your Church';
        }

        $totalGivings = (clone $givings)->count();
        $approvedGivings = (clone $givings)->where('status', 'approved');
        $pendingGivings = (clone $givings)->where('status', 'pending')->count();

        return [
            Stat::make('Total Givings', $totalGivings)
                ->description($label === 'All Churches' ? 'All givings across every church' : 'All giving records for your church')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
            Stat::make('Total Amount', '₱' . number_format($approvedGivings->sum('amount'), 2))
                ->description($label === 'All Churches' ? 'Approved giving amount across all churches' : 'Approved giving amount collected')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
            Stat::make('Pending Approvals', $pendingGivings)
                ->description('Givings awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
