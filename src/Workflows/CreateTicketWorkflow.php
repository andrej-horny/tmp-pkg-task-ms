<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Commands\Ticket\CreateTicketCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Ticket\CreateTicketHandler;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\CreateTicketAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTicketWorkflow
{
    public function __construct(
        private CreateTicketHandler $ticketCHdl,
        private CreateTicketAssignmentHandler $ticketAssignmentCHdl,
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
    ) {}

    public function handle(
        CreateTicketCommand $ticketCCmd,
        CreateTicketAssignmentCommand $ticketAssignmentCCmd,
        CreateTaskCommand $taskCCmd,
        CreateTaskAssignmentCommand $taskAssignmentCCmd,
        ): Model
    {
        return DB::transaction(function () use ($ticketCCmd, $ticketAssignmentCCmd, $taskCCmd, $taskAssignmentCCmd) {
            // create ticket
            $ticket = $this->ticketCHdl->handle($ticketCCmd);
            $ticketAssignment = $this
                ->ticketAssignmentCHdl
                ->handle($ticketAssignmentCCmd->withRelations($ticket->id));
            $task = $this->taskCHdl->handle($taskCCmd);
            $taskAssignment = $this
                ->taskAssignmentCHdl
                ->handle($taskAssignmentCCmd->withRelations($task->id, $ticketAssignment->subject_id, $ticketAssignment->subject_type));

            return $ticketAssignment;
        });
    }
}
