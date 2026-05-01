<?php

namespace App\Filament\Resources\Churches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ChurchInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('code')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('contact_number')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('city')
                    ->placeholder('-'),
                TextEntry::make('province')
                    ->placeholder('-'),
                TextEntry::make('date_established')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->badge(),

                TextEntry::make('status')
                    ->badge(),

            ]);
    }
}
