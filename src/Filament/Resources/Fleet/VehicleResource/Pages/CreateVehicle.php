<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle.create_heading');
    }      
}
