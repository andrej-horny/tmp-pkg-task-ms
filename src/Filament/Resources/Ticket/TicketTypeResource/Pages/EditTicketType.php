<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTicketType extends EditRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket-type.update_heading', ['title' => $this->record->title]);
    }        
}
