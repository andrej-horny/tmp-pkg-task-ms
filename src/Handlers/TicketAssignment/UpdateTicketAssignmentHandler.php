<?php

namespace Dpb\Package\TaskMS\Handlers\TicketAssignment;

use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\Commands\TicketAssignment\UpdateTicketAssignmentCommand;
use Dpb\Package\Tickets\Models\Ticket;

final class UpdateTicketAssignmentHandler
{
    public function __construct(
        private TicketAssignment $eloquentModel,
        private Ticket $ticketModel
    ) {}

    public function handle(UpdateTicketAssignmentCommand $command)
    {
        // update ticket 
        $ticket = $this->ticketModel->find($command->ticket->id);
        $ticket->fill([
            'date' => $command->ticket->date,
            'description' => $command->ticket->description,
            'type_id' => $command->ticket->type_id,
            'state' => $command->ticket->state,
        ]);
        $ticket->save();

        // update ticket assignment
        $ticketAssignment = $this->eloquentModel->find($command->id);
        $ticketAssignment->fill([
            'ticket_id' => $ticket->id,
            'subject_id' => $command->subject_id,
            'subject_type' => $command->subject_type,
        ]);
        $ticketAssignment->save();

        return $ticketAssignment;
    }
}
