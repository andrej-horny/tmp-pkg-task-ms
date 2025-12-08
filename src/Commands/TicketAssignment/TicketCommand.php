<?php

namespace Dpb\Package\TaskMS\Commands\TicketAssignment;

class TicketCommand
{
    public function __construct(
        public ?int $id,
        public \DateTimeImmutable $date,
        public ?string $description,
        public int $type_id,
        public string $state,

    ) {}
}
