<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('church_id')
                    ->numeric(),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name')
                    ->placeholder('-'),
                TextEntry::make('last_name'),
                TextEntry::make('birthdate')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('gender')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('contact_number')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('member_status'),
                TextEntry::make('membership_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
