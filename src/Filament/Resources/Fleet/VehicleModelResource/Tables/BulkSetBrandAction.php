<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Tables;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms\BrandPicker;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class BulkSetBrandAction
{
    public static function make($uri): BulkAction
    {
        return BulkAction::make($uri)
            ->label(__('tms-ui::fleet/vehicle-model.table.actions.bulk_set_vehicle-brand'))
            ->form([
                BrandPicker::make('vehicle_brand_id')
                    ->relationship('brand', 'title')
            ])
            ->action(function (array $data, Collection $records) {
                // dd($records);
                foreach ($records as $record) {
                    $record->brand_id = $data['vehicle_brand_id'];
                    $record->save();
                }
            });
    }
}
