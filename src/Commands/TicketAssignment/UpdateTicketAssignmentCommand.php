<?php

namespace Dpb\Package\TaskMS\Commands\TicketAssignment;

final readonly class UpdateTicketAssignmentCommand
{
    public function __construct(
        public int $id,
        public TicketCommand $ticket,
        public int $subject_id,
        public string $subject_type,
    ) {}
}