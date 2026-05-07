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
use Filament\Forms\Components\Select;
use App\Models\FiscalYear;
use Filament\Facades\Filament;


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


        $query = parent::getEloquentQuery();

        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();

        if (!$user) {
            return $query->whereRaw('1 = 0');
        }

        if ($user->hasRole('super-admin')) {
            return $query;
        }

        // ALWAYS resolve church safely
        $churchId = $user->church_id ?? $user->effective_church_id;

        if (!$churchId) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('church_id', $churchId);
    }

    public static function canViewAny(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user && $user->hasAnyRole([
            'super-admin',
            'district-treasurer',
            'church-treasurer',
            'pastor',
        ]);
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();

        return $user && $user->hasAnyRole([
            'super-admin',
            'district-treasurer',
            'church-treasurer',
            'pastor',
        ]);
    }

    public static function canEditRecord(Giving $record): bool
    {

        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canDeleteRecord(Giving $record): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();
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

    public static function shouldRegisterNavigation(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();

        return $user && $user->hasAnyRole([
            'super-admin',
            'district-treasurer',
            'church-treasurer',
            'pastor',
        ]);
    }
}
