<?php

namespace App\Filament\Resources\Users;

use App\Models\User;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use UnitEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $user = filament()->auth()->user();

        $query = parent::getEloquentQuery();

        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        // Super admin sees everything
        if ($user->hasRole('super-admin')) {
            return $query;
        }

        // Pastor sees only their church
        if ($user->hasRole('pastor')) {
            return $query->where('church_id', $user->church_id);
        }

        // Everyone else sees nothing
        return $query->whereRaw('1 = 0');
    }


    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Users';

    protected static string|UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canViewAny(): bool
    {
        return filament()->auth()->user()?->hasRole('super-admin') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required(),

            TextInput::make('email')
                ->email()
                ->required()
                ->unique(User::class, 'email')
                ->uniqueValidationIgnoresRecordByDefault(),

            TextInput::make('password')
                ->password()
                ->required(fn($context) => $context === 'create')
                ->dehydrated(fn($state) => filled($state))
                ->dehydrateStateUsing(fn($state) => Hash::make($state)),

            Select::make('role')
                ->options([
                    'super-admin' => 'Super Admin',
                    'district-superintendent' => 'District Superintendent',
                    'pastor' => 'Pastor',
                    'church-secretary' => 'Church Secretary',
                    'church-treasurer' => 'Church Treasurer',
                    'district-treasurer' => 'District Treasurer',
                    'district-secretary' => 'District Secretary',
                ])
                ->required(),

            Select::make('church_id')
                ->label('Church')
                ->relationship('church', 'name')
                ->searchable()
                ->preload()
                ->nullable()
                ->visible(fn($get) => in_array($get('role'), ['pastor', 'church-secretary', 'church-treasurer'], true)),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),

            TextColumn::make('email'),

            TextColumn::make('church.name')
                ->label('Church')
                ->searchable(),

            TextColumn::make('roles.name')
                ->label('Role')
                ->badge()

        ])


            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
