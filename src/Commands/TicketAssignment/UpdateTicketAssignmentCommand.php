<?php

namespace Dpb\Package\TaskMS\Commands\TicketAssignment;

final readonly class UpdateTicketAssignmentCommand
{
    public function __construct(
        public int $id,
        public int $ticketId,
        public int $subjectId,
        public string $subjectType,
    ) {}
}