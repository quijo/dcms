<?php

namespace App\Filament\Resources\Givings\Pages;

use App\Filament\Resources\Givings\GivingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGiving extends ViewRecord
{
    protected static string $resource = GivingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
