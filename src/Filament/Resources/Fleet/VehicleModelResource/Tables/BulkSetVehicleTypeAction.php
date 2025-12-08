<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Tables;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms\VehicleTypePicker;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class BulkSetVehicleTypeAction
{
    public static function make($uri): BulkAction
    {
        return BulkAction::make($uri)
            ->label(__('tms-ui::fleet/vehicle-model.table.actions.bulk_set_vehicle_type'))
            ->form([
                VehicleTypePicker::make('type_id')
                    ->relationship('type', 'title')
            ])
            ->action(function (array $data, Collection $records) {
                // dd($records);
                foreach ($records as $record) {
                    $record->type_id = $data['type_id'];
                    $record->save();
                }
            });
    }
}
