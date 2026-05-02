<?php

namespace App\Filament\Pages;

use App\Models\Giving;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use UnitEnum;

class GivingReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Giving Reports';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected string $view = 'filament.pages.giving-report';

    public static function canView(): bool
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return false;
        }

        return $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']) || $user->can('view giving reports');
    }

    public function getViewData(): array
    {
        $totalGivings = Giving::sum('amount');

        $byType = Giving::with('givingType')
            ->selectRaw('giving_type_id, SUM(amount) as total')
            ->groupBy('giving_type_id')
            ->get();

        $monthly = Giving::selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get();

        return compact('totalGivings', 'byType', 'monthly');
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return false;
        }

        return in_array($user->role, [
            'super-admin',
            'district-treasurer',
            'district-superintendent',
        ]);
    }
}
