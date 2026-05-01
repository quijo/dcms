<?php

namespace App\Filament\Resources\Churches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;


class ChurchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('contact_number')
                    ->default(null),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('province')
                    ->default(null),
                DatePicker::make('date_established'),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),
                Select::make('type')
                    ->options([
                        'mission' => 'Mission Church',
                        'organized' => 'Organized Church',
                    ])
                    ->required(),
            ]);
    }
}
