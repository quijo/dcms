<?php

namespace App\Filament\Resources\FiscalYears;

use App\Filament\Resources\FiscalYears\Pages\CreateFiscalYear;
use App\Filament\Resources\FiscalYears\Pages\EditFiscalYear;
use App\Filament\Resources\FiscalYears\Pages\ListFiscalYears;
use App\Filament\Resources\FiscalYears\Pages\ViewFiscalYear;
use App\Filament\Resources\FiscalYears\Schemas\FiscalYearForm;
use App\Filament\Resources\FiscalYears\Schemas\FiscalYearInfolist;
use App\Filament\Resources\FiscalYears\Tables\FiscalYearsTable;
use App\Models\FiscalYear;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Facades\Filament;

class FiscalYearResource extends Resource
{
    protected static ?string $model = FiscalYear::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';


    public static function canViewAny(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();


        return $user && $user->hasAnyRole([
            'super-admin',
            'district-treasurer',
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return FiscalYearForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FiscalYearInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FiscalYearsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFiscalYears::route('/'),
            'create' => CreateFiscalYear::route('/create'),
            'view' => ViewFiscalYear::route('/{record}'),
            'edit' => EditFiscalYear::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['is_active']) {
            FiscalYear::where('is_active', true)
                ->update(['is_active' => false]);
        }

        return $data;
    }
}
