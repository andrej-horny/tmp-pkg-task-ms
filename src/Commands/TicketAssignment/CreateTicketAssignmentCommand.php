<?php

namespace Dpb\Package\TaskMS\Commands\TicketAssignment;

final readonly class CreateTicketAssignmentCommand
{
    public function __construct(
        public ?int $id,
        public ?TicketCommand $ticket,
        public int $subject_id,
        public string $subject_type,
        public int $author_id,
    ) {}
}