<?php

namespace App\Filament\Resources\Givings\Pages;

use App\Filament\Resources\Givings\GivingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGivings extends ListRecords
{
    protected static string $resource = GivingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
