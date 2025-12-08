<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }     
}
