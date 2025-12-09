<?php

namespace Dpb\Package\TaskMS\Commands\Ticket;

final readonly class CreateTicketCommand
{
    public function __construct(
        public \DateTimeImmutable $date,
        public ?string $description,
        public int $typeId,
        public string $state,

    ) {}
}
