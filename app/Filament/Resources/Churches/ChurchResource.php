<?php

namespace App\Filament\Resources\Churches;



use App\Filament\Resources\Churches\Pages\CreateChurch;
use App\Filament\Resources\Churches\Pages\EditChurch;
use App\Filament\Resources\Churches\Pages\ListChurches;
use App\Filament\Resources\Churches\Pages\ViewChurch;
use App\Filament\Resources\Churches\Schemas\ChurchForm;
use App\Filament\Resources\Churches\Schemas\ChurchInfolist;
use App\Filament\Resources\Churches\Tables\ChurchesTable;
use App\Models\Church;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
// use Filament\Infolists\Components\TextEntry;
// use Illuminate\Support\Facades\Auth;
// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\TextInput;
use App\Filament\Widgets\ChurchStats;
use Filament\Facades\Filament;

class ChurchResource extends Resource
{
    protected static ?string $model = Church::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ChurchForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema

    {

        return ChurchInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChurchesTable::configure($table);
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
            'index' => ListChurches::route('/'),
            'create' => CreateChurch::route('/create'),
            'view' => ViewChurch::route('/{record}'),
            'edit' => EditChurch::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();
        if ($user->hasRole('admin')) {
            // Allow admin users to create churches
            return true;
        }
        return $user->hasRole('super-admin');
    }

    public static function getWidgets(): array
    {
        return [
            ChurchStats::class,
        ];
    }
}
