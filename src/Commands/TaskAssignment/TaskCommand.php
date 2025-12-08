<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

class TaskCommand 
{
    public function __construct(
        public ?int $id,
        public \DateTimeImmutable $date,
        public ?string $title,
        public ?string $description,
        public int $group_id,
        public ?string $state,
    ) {}
}
