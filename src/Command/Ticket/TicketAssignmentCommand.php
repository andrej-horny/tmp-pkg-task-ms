<?php

namespace App\Command\Ticket;

class TicketAssignmentCommand
{
    public function __construct(
        public ?int $id,
        public ?TicketCommand $Ticket,
        public int $subject_id,
        public string $subject_type,
        public int $author_id,
    ) {}
}
