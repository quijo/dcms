<?php

namespace App\Filament\Resources\Pastors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PastorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('church_id')
                    ->numeric(),
                TextEntry::make('first_name'),
                TextEntry::make('Middle_name'),
                TextEntry::make('last_name'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('contact_number')
                    ->placeholder('-'),
                TextEntry::make('role'),
                TextEntry::make('type'),
                TextEntry::make('ordination_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
