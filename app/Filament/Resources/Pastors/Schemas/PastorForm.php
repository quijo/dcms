<?php

namespace App\Filament\Resources\Pastors\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class PastorForm
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
                TextInput::make('Middle_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('contact_number')
                    ->default(null),
                Select::make('role')
                    ->label('Pastor Role')
                    ->options([
                        'senior_pastor' => 'Senior Pastor',
                        'co_pastor' => 'Co-Pastor',
                        'associate_pastor' => 'Associate Pastor',
                        'supply_pastor' => 'Supply Pastor',
                    ])
                    ->default('associate_pastor')
                    ->required(),
                Select::make('type')
                    ->label('Ministry Level')
                    ->options([
                        'ordained' => 'Ordained',
                        'district_license' => 'District License',
                        'local_license' => 'Local License',
                    ])
                    ->default('local_license')
                    ->required(),
                DatePicker::make('ordination_date'),
                Select::make('Status')
                    ->label('Assignment Status')
                    ->options([
                        'Assigned' => 'Assigned',
                        'Unassigned' => 'Unassigned',
                        'Resigned' => 'Resigned',
                    ])
                    ->default('Assigned')
                    ->required(),
            ]);
    }
}
