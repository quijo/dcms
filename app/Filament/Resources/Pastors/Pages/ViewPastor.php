<?php

namespace App\Filament\Resources\Pastors\Pages;

use App\Filament\Resources\Pastors\PastorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPastor extends ViewRecord
{
    protected static string $resource = PastorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
