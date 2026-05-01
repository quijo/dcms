<?php

namespace App\Filament\Resources\Givings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GivingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('church.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('givingType.name')
                    ->label('Type')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('member.name')
                    ->label('Giver')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('receipt_number')
                    ->searchable(),
                // TextColumn::make('reference_number')
                //     ->searchable(),
                // TextColumn::make('proof_path')
                //     ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
