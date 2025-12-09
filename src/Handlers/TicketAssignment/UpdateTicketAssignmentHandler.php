<?php

namespace Dpb\Package\TaskMS\Handlers\TicketAssignment;

use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\Commands\TicketAssignment\UpdateTicketAssignmentCommand;

final class UpdateTicketAssignmentHandler
{
    public function __construct(
        private TicketAssignment $eloquentModel,
    ) {}

    public function handle(UpdateTicketAssignmentCommand $command)
    {
        $ticketAssignment = $this->eloquentModel->find($command->id);
        $ticketAssignment->fill([
            'ticket_id' => $command->ticketId,
            'subject_id' => $command->subjectId,
            'subject_type' => $command->subjectType,
        ]);
        $ticketAssignment->save();

        return $ticketAssignment;
    }
}
