<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListVehicleGroups extends ListRecords
{
    protected static string $resource = VehicleGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }      
}
