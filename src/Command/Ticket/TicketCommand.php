<?php

namespace App\Command\Ticket;

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
