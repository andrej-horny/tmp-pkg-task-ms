<?php

namespace Dpb\Package\TaskMS\Handlers\TicketAssignment;

use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;
use Dpb\Package\Tickets\Models\Ticket;

final class CreateTicketAssignmentHandler
{
    public function __construct(
        private TicketAssignment $eloquentModel,
        private Ticket $ticketModel
    ) {}

    public function handle(CreateTicketAssignmentCommand $command)
    {
        // create ticket 
        $ticket = $this->ticketModel->create([
            'date' => $command->ticket->date,
            'description' => $command->ticket->description,
            'type_id' => $command->ticket->type_id,
            'state' => $command->ticket->state,
        ]);

        // create ticket assignment
        return $this->eloquentModel->create([
            'ticket_id' => $ticket->id,
            'subject_id' => $command->subject_id,
            'subject_type' => $command->subject_type,
            'author_id' => $command->author_id,
        ]);
    }
}
