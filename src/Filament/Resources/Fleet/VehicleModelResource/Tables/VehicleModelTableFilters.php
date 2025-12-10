<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Tables;

use Filament\Tables;

class VehicleModelTableFilters
{
    public static function make(): array
    {
        return [
            // type
            Tables\Filters\SelectFilter::make('type')
                ->label(__('tms-ui::fleet/vehicle-model.table.filters.type'))
                ->relationship('type', 'title')
                ->searchable()
                ->multiple()
                ->preload(),
            // brand
            Tables\Filters\SelectFilter::make('brand')
                ->label(__('tms-ui::fleet/vehicle-model.table.filters.brand'))
                ->relationship('brand', 'title')
                ->searchable()
                ->multiple()
                ->preload(),
        ];
    }
}
