<?php

namespace App\Filament\Resources\Givings\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

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

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('php', true)
                    ->sortable(),

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
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('approver.name')
                    ->label('Approved By')
                    ->sortable()
                    ->searchable(),
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
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(function ($record) {
                        $user = Auth::user();

                        return $record->status === 'pending'
                            && $user
                            && in_array($user->role, [
                                'church-treasurer',
                                'district-treasurer',
                                'super-admin',
                            ]);
                    })
                    //   $user = Auth::user();
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                        ]);
                    })
                    ->requiresConfirmation()
                    ->successNotificationTitle('Giving Approved')
                    ->successNotificationTitle('Giving approved successfully'),

                ViewAction::make(),
                EditAction::make()
                    ->visible(function () {
                        $user = Auth::user();

                        return $user && in_array($user->role, [
                            'church-treasurer',
                            'district-treasurer',
                            'super-admin',
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
