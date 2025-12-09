<?php

namespace Dpb\Package\TaskMS\Commands\TicketAssignment;

final readonly class CreateTicketAssignmentCommand
{
    public function __construct(
        public int $ticketId,
        public int $subjectId,
        public string $subjectType,
        public int $authorId,
    ) {}
}