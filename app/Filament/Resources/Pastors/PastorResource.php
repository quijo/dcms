<?php

namespace App\Filament\Resources\Pastors;

use App\Filament\Resources\Pastors\Pages\CreatePastor;
use App\Filament\Resources\Pastors\Pages\EditPastor;
use App\Filament\Resources\Pastors\Pages\ListPastors;
use App\Filament\Resources\Pastors\Pages\ViewPastor;
use App\Filament\Resources\Pastors\Schemas\PastorForm;
use App\Filament\Resources\Pastors\Schemas\PastorInfolist;
use App\Filament\Resources\Pastors\Tables\PastorsTable;
use App\Models\Pastor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

use Illuminate\Support\Facades\Auth;

class PastorResource extends Resource
{
    protected static ?string $model = Pastor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canCreate(): bool
    {
        $user = filament()->auth()->user();

        return $user && $user->hasAnyRole([
            'super-admin',
            'admin',
        ]);
    }


    public static function form(Schema $schema): Schema
    {
        return PastorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PastorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PastorsTable::configure($table);
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
            'index' => ListPastors::route('/'),
            'create' => CreatePastor::route('/create'),
            'view' => ViewPastor::route('/{record}'),
            'edit' => EditPastor::route('/{record}/edit'),
        ];
    }
}
