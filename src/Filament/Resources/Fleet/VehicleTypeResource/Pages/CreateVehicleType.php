<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateVehicleType extends CreateRecord
{
    protected static string $resource = VehicleTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-type.create_heading');
    }     
}
