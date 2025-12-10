<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms;

use Dpb\Package\Fleet\Models\VehicleModel;
use Filament\Forms;
use Filament\Forms\Form;

class VehicleTypeForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            // code
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::fleet/vehicle-type.form.fields.code.label')),
            // title
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::fleet/vehicle-type.form.fields.title')),
            // models
            Forms\Components\CheckboxList::make('models')
                ->label(__('tms-ui::fleet/vehicle-type.form.fields.vehicle_models.label'))
                ->hint(__('tms-ui::fleet/vehicle-type.form.fields.vehicle_models.hint'))
                ->options(function () {
                    return VehicleModel::get()
                        ->mapWithKeys(fn($vehicleModel) => [
                            $vehicleModel->id => $vehicleModel->title
                        ]);
                })
                ->searchable()
                ->bulkToggleable(true)
                ->columnSpanFull()
                ->columns(5)

        ];
    }
}
