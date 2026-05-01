<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;


class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('church_id')
                    ->label('Church')
                    ->relationship('church', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name')
                    ->default(null),
                TextInput::make('last_name')
                    ->required(),
                DatePicker::make('birthdate'),
                TextInput::make('gender')
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
                TextInput::make('member_status')
                    ->required()
                    ->default('active'),
                DatePicker::make('membership_date'),
            ]);
    }
}
