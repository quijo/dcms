<?php

namespace App\Filament\Resources\Givings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class GivingForm
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
                Select::make('giving_type_id')
                    ->label('Giving Type')
                    ->relationship('givingType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('member_id')
                    ->label('Member')
                    ->relationship('member', 'first_name') // or first_name if no accessor
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('receipt_number')
                    ->default(null),
                // TextInput::make('reference_number')
                //     ->default(null),
                // TextInput::make('proof_path')
                //     ->default(null),
                TextInput::make('status')
                    ->default('pending')
                    ->disabled()
                    ->dehydrated(), // IMPORTANT: still saves to DB
                TextInput::make('approved_by')
                    ->numeric()
                    ->default(null),
                DateTimePicker::make('approved_at'),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
