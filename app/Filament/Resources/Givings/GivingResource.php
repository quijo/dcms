<?php

namespace App\Filament\Resources\Givings;

use App\Filament\Resources\Givings\Pages\CreateGiving;
use App\Filament\Resources\Givings\Pages\EditGiving;
use App\Filament\Resources\Givings\Pages\ListGivings;
use App\Filament\Resources\Givings\Pages\ViewGiving;
use App\Filament\Resources\Givings\Schemas\GivingForm;
use App\Filament\Resources\Givings\Schemas\GivingInfolist;
use App\Filament\Resources\Givings\Tables\GivingsTable;
use App\Models\Giving;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Widgets\DistrictBudgetStats;
use Illuminate\Support\Facades\Auth;

class GivingResource extends Resource
{
    protected static ?string $model = Giving::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GivingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GivingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GivingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            DistrictBudgetStats::class,
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $user = filament()->auth()->user();

        $query = parent::getEloquentQuery();

        if (! $user) {
            return $query->whereRaw('1 = 0'); // safety: no user = no data
        }

        // Super admin sees everything
        if ($user->hasRole('super-admin')) {
            return $query;
        }

        // District treasurer sees everything (or you can refine later)
        if ($user->hasRole('district-treasurer')) {
            return $query;
        }

        // Church users see only their church
        if ($user->church_id) {
            return $query->where('church_id', $user->church_id);
        }

        return $query->whereRaw('1 = 0'); // no church = no data
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canAccess(): bool
    {
        $user = filament()->auth()->user();

        return $user?->hasRole('super-admin')
            || $user?->hasRole('district-treasurer');
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user() ?? auth()->guard('web')->user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canDelete($record): bool
    {
        $user = auth()->user() ?? auth()->guard('web')->user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }


    // public static function canAccess(): bool
    // {
    //     $user = auth()->user() ?? auth()->guard('web')->user();

    //     return $user && (
    //         $user->hasRole('super-admin') ||
    //         $user->hasRole('district-treasurer')
    //     );
    // }

    public static function getPages(): array
    {
        return [
            'index' => ListGivings::route('/'),
            'create' => CreateGiving::route('/create'),
            'view' => ViewGiving::route('/{record}'),
            'edit' => EditGiving::route('/{record}/edit'),
        ];
    }
}
