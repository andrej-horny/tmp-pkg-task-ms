<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Pages;

use DateTimeImmutable;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\TicketCommand;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\CreateTicketAssignmentHandler;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;

class CreateTicketAssignment extends CreateRecord
{
    protected static string $resource = TicketAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $ticketCmd = new TicketCommand(
            null,
            new DateTimeImmutable($data['date']),
            $data['description'] ?? null,
            $data['type_id'],
            States\Ticket\Created::$name,
        );

        $taCmd = new CreateTicketAssignmentCommand(
            null,
            $ticketCmd,
            $data['subject_id'],
            'vehicle',
            auth()->user()->id,
        );

        return app(CreateTicketAssignmentHandler::class)->handle($taCmd);
    }
}
