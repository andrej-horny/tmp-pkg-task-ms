<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Tables;

use Dpb\Package\TaskMS\Filament\Components\VehiclePicker;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Tickets\Models\TicketSource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Dpb\Package\TaskMS\States;

class DailyExpeditionTableFilters
{
    public static function make(): array
    {
        return [
            // model
            Tables\Filters\SelectFilter::make('vehicle.model')
                ->label(__('fleet/vehicle.table.columns.model'))
                ->relationship('vehicle.model', 'title')
                ->searchable()
                ->multiple()
                ->preload(),
            // state
            Tables\Filters\SelectFilter::make('state')
                ->label(__('fleet/vehicle.table.columns.state'))
                ->searchable()
                ->multiple()
                ->preload()
                ->options([
                    'in-service' => __('tms-ui::fleet/daily-expedition.states.in-service'),
                    'split-service' => __('tms-ui::fleet/daily-expedition.states.split-service'),
                    'out-of-service' => __('tms-ui::fleet/daily-expedition.states.out-of-service'),
                ]),
            // maintenance group
            Tables\Filters\SelectFilter::make('vehicle.maintenanceGroup')
                ->label(__('fleet/vehicle.table.columns.maintenance_group.label'))
                ->relationship('vehicle.maintenanceGroup', 'title')
                ->searchable()
                ->preload()
                ->multiple()
                ->options(fn() => MaintenanceGroup::pluck('title')),
        ];
    }
}
