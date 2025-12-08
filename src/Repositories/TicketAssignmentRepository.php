<?php

namespace Dpb\Package\TaskMS\Repositories;

use Dpb\Package\TaskMS\Data\Ticket\TicketAssignmentData;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Ticket\TicketAssignmentMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Ticket\TicketMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\Models\TicketAssignment;

class TicketAssignmentRepository
{
    public function __construct(
        private TicketAssignment $eloquentModel,
        private TicketMDpb\Package\TaskMSer $ticketMDpb\Package\TaskMSer,
        private TicketAssignmentMDpb\Package\TaskMSer $ticketAssignmentMDpb\Package\TaskMSer
        ) {}

    public function findById(int $id): ?TicketAssignment
    {
        $model = $this->eloquentModel->findOrFail($id);

        return $model;
    }

    public function save(TicketAssignmentData $ticketAssignmentData): ?TicketAssignment
    {
        // create ticket
        $ticket = $this->ticketMDpb\Package\TaskMSer->toEloquent($ticketAssignmentData->ticket);
        $ticket->save();

        $ticketAssignment = $this->ticketAssignmentMDpb\Package\TaskMSer->toEloquent($ticketAssignmentData);
        // dd($ticketAssignment);
        $ticketAssignment->ticket()->associate($ticket);
        $ticketAssignment->save();

        return $ticketAssignment;
    }

    public function push(TicketAssignment $ticketAssignment): ?TicketAssignment
    {
        $ticketAssignment->push();
        return $ticketAssignment;
    }    
}