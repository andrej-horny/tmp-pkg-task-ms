<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Pages;

use DateTimeImmutable;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\Ticket\CreateTicketCommand;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource;
use Dpb\Package\TaskMS\Commands\TicketAssignment\CreateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Ticket\CreateTicketHandler;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\CreateTicketAssignmentHandler;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\TaskGroup;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tickets\Models\TicketGroup;
use Illuminate\Support\Facades\DB;

class CreateTicketAssignment extends CreateRecord
{
    protected static string $resource = TicketAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket.create_heading');
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create ticket
            $ticket = app(CreateTicketHandler::class)->handle(
                new CreateTicketCommand(
                    new DateTimeImmutable($data['date']),
                    $data['description'] ?? null,
                    $data['type_id'],
                    States\Ticket\Created::$name,
                )
            );

            // create ticket assignment
            $subject = Vehicle::find($data['subject_id'])->first();
            $ticketAssignment = app(CreateTicketAssignmentHandler::class)->handle(
                new CreateTicketAssignmentCommand(
                    $ticket->id,
                    $subject->id,
                    $subject->getMorphClass(),
                    auth()->user()->id,
                )
            );

            // create task
            $taskGroupId = TaskGroup::byCode('accident')->first()->id;
            $placeOfOriginId = PlaceOfOrigin::byUri('in-service')->first()?->id;
            $task = app(CreateTaskHandler::class)->handle(
                new CreateTaskCommand(
                    new DateTimeImmutable($data['date']),
                    null,
                    $data['description'] ?? null,
                    $taskGroupId,
                    States\Task\Task\Created::$name,
                    $placeOfOriginId
                )
            );

            // create task assignment
            $taskAssignment = app(CreateTaskAssignmentHandler::class)->handle(
                new CreateTaskAssignmentCommand(
                    $task->id,
                    $data['subject_id'],
                    'vehicle',
                    $ticket->id,
                    $ticket->getMorphClass(),
                    auth()->user()->id,
                    $data['assigned_to_id'] ?? null,
                    isset($data['assigned_to_id']) ? 'maintenance-group' : null
                )
            );

            return $ticketAssignment;
        });
    }
}
