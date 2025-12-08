<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms\BrandPicker;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms\VehicleTypePicker;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Dpb\Package\Fleet\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;

class VehiclesTab
{
    public static function make(): array
    {
        return [
            Forms\Components\CheckboxList::make('vehicles')
                ->label(__('tms-ui::fleet/maintenance-group.form.fields.vehicles'))
                ->options(function () {
                    return Vehicle::with('codes')
                        ->get()
                        ->mapWithKeys(fn($vehicle) => [
                            $vehicle->id => $vehicle->code->code
                        ]);
                })
                ->searchable()
                ->bulkToggleable(true)
                ->columnSpanFull()
                ->columns(10)
        ];
    }
}
