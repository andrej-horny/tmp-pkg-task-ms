<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;


    public function getTitle(): string | Htmlable
    {
        return 'vozidlo: ' . $this->record->code->code;
    }

    public function getHeading(): string
    {        
        return 'vozidlo: ' . $this->record->code->code;
    }
}
