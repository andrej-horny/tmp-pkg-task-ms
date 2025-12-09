<?php

namespace Dpb\Package\TaskMS\Commands\Ticket;

final readonly class UpdateTicketCommand
{
    public function __construct(
        public int $id,
        public \DateTimeImmutable $date,
        public ?string $description,
        public int $typeId,
        public string $state,

    ) {}
}
