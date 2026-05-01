<?php

namespace App\Filament\Resources\Givings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GivingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('church_id')
                    ->numeric(),
                TextEntry::make('giving_type_id')
                    ->numeric(),
                TextEntry::make('member_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('receipt_number')
                    ->placeholder('-'),
                TextEntry::make('reference_number')
                    ->placeholder('-'),
                TextEntry::make('proof_path')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('approved_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('approved_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
