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
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if (!$user) {
            return $query;
        }

        // Super admin can see all
        if ($user->hasRole('super-admin')) {
            return $query;
        }

        // Other users only see their church's givings.
        $churchId = $user->church_id ?: $user->effective_church_id;

        if ($churchId) {
            return $query->where('church_id', $churchId);
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canCreate(): bool
    {
        $user = Auth::user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }

    public static function canDelete($record): bool
    {
        $user = Auth::user();
        return $user && $user->hasRole(['super-admin', 'church-treasurer', 'district-treasurer']);
    }


    public static function canAccess(): bool
    {
        $user = Auth::user();

        return $user && (
            $user->hasRole('super-admin') ||
            $user->hasRole('district-treasurer')
        );
    }

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
