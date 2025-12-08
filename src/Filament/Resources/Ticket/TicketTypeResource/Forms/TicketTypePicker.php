<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Forms;

use Dpb\Package\Tickets\Models\TicketType;
use Filament\Forms;

class TicketTypePicker
{
    public static function make(string $uri)
    {
        return Forms\Components\ToggleButtons::make($uri)
            ->label(__('tms-ui::tickets/ticket.form.fields.type'))
            ->inline()
            ->columnSpan(1)
            ->options(
                fn() =>
                TicketType::pluck('title', 'id')
            );
        // return Forms\Components\Select::make($uri)
        //     ->label(__('fleet/vehicle-type.components.picker.label'))
        //     ->searchable()
        //     ->preload()
        //     ->createOptionForm(VehicleTypeForm::schema())
        //     ->createOptionModalHeading(__('fleet/vehicle-type.components.picker.create_heading'))
        //     ->editOptionForm(VehicleTypeForm::schema())
        //     ->editOptionModalHeading(__('fleet/vehicle-type.components.picker.update_heading'));
    }
}
