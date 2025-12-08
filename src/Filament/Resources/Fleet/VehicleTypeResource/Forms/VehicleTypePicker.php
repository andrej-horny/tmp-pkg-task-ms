<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms;

use Filament\Forms;

class VehicleTypePicker
{
    public static function make(string $uri)
    {
        return Forms\Components\Select::make($uri)
            ->label(__('tms-ui::fleet/vehicle-type.components.picker.label'))
            ->searchable()
            ->preload()
            ->createOptionForm(VehicleTypeForm::schema())
            ->createOptionModalHeading(__('tms-ui::fleet/vehicle-type.components.picker.create_heading'))
            ->editOptionForm(VehicleTypeForm::schema())
            ->editOptionModalHeading(__('tms-ui::fleet/vehicle-type.components.picker.update_heading'));
    }
}
