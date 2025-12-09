<?php

namespace Dpb\Package\TaskMS\Handlers\TicketAssignment;

use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;

final class CreateTicketAssignmentHandler
{
    public function __construct(
        private TicketAssignment $eloquentModel,
    ) {}

    public function handle(CreateTicketAssignmentCommand $command)
    {
        return $this->eloquentModel->create([
            'ticket_id' => $command->ticketId,
            'subject_id' => $command->subjectId,
            'subject_type' => $command->subjectType,
            'author_id' => $command->authorId,
        ]);
    }
}
