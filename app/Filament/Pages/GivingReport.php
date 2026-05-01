<?php

namespace App\Filament\Pages;

use App\Models\Giving;
use BackedEnum;
use Illuminate\Support\Facades\DB;
use UnitEnum;
use Filament\Pages\Page;

class GivingReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Giving Reports';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected string $view = 'filament.pages.giving-report';

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
}
