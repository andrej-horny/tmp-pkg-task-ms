<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateFromTicketCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Commands\Ticket\CreateTicketCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Data\DTOs\CreateTaskAssignmentDTO;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Ticket\CreateTicketHandler;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\CreateTicketAssignmentHandler;
use Dpb\Package\TaskMS\Resolvers\TaskSourceResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTicketWorkflow
{
    public function __construct(
        private CreateTicketHandler $ticketCHdl,
        private CreateTicketAssignmentHandler $ticketAssignmentCHdl,
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
        private TaskSourceResolver $taskSourceResolver,
    ) {}

    public function handle(
        CreateTicketCommand $ticketCCmd,
        CreateTicketAssignmentCommand $ticketAssignmentCCmd,
        CreateTaskCommand $taskCCmd,
        CreateFromTicketCommand $taskAssignmentCCmd,
    ): Model {
        return DB::transaction(function () use ($ticketCCmd, $ticketAssignmentCCmd, $taskCCmd, $taskAssignmentCCmd) {
            // create ticket
            $ticket = $this->ticketCHdl->handle($ticketCCmd);
            // create ticket assignment
            $ticketAssignment = $this
                ->ticketAssignmentCHdl
                ->handle($ticketAssignmentCCmd->withRelations($ticket->id));
                // create task
            $task = $this->taskCHdl->handle($taskCCmd);
            // create task assignment
            $taskSource = $this->taskSourceResolver->resolve('ticket', $ticket->id);
            $taCreateDTO = CreateTaskAssignmentDTO::fromTicket($taskAssignmentCCmd->withRelations($task->id, $taskSource));
            $taskAssignment = $this
                ->taskAssignmentCHdl
                // ->handle($taskAssignmentCCmd->withRelations($task->id, $ticketAssignment->subject_id, $ticketAssignment->subject_type));
                ->handle($taCreateDTO);

            return $ticketAssignment;
        });
    }
}
