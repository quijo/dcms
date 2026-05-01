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
