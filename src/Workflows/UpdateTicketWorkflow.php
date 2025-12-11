<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Ticket\UpdateTicketCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\UpdateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Ticket\UpdateTicketHandler;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\UpdateTicketAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateTicketWorkflow
{
    public function __construct(
        private UpdateTicketHandler $ticketUHdl,
        private UpdateTicketAssignmentHandler $ticketAssignmentUHdl,
    ) {}

    public function handle(
        UpdateTicketCommand $ticketUCmd,
        UpdateTicketAssignmentCommand $ticketAssignmentUCmd,
    ): Model {
        return DB::transaction(function () use ($ticketUCmd, $ticketAssignmentUCmd) {
            // update ticket
            $ticket = $this->ticketUHdl->handle($ticketUCmd);
            // update ticket assignment
            $ticketAssignment = $this->ticketAssignmentUHdl->handle($ticketAssignmentUCmd);

            return $ticketAssignment;
        });
    }
}
