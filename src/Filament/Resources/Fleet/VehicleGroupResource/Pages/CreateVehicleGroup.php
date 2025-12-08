<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateVehicleGroup extends CreateRecord
{
    protected static string $resource = VehicleGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-group.create_heading');
    }     
}
