<?php

namespace Dpb\Package\TaskMS\Commands\Task;

use DateTimeImmutable;

class TaskItemCommand
{
    public function __construct(
        public int $id,
        public DateTimeImmutable $date,
        public int $TaskId,
        public string $title,
        public string $description,
        public string $state,
        
    ) {}
}
