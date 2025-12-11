<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class TicketSubjectDTO
{
    public function __construct(
        public int $id,
        public string $morphClass,
    ) {}
}