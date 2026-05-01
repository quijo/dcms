<?php

namespace App\Filament\Resources\Givings\Pages;

use App\Filament\Resources\Givings\GivingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGiving extends EditRecord
{
    protected static string $resource = GivingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
