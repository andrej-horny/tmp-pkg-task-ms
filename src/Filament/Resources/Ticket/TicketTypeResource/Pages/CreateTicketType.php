<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTicketType extends CreateRecord
{
    protected static string $resource = TicketTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket-type.create_heading');
    }        
}
