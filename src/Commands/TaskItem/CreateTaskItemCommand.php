<?php

namespace Dpb\Package\TaskMS\Commands\TaskItem;

final readonly class CreateTaskItemCommand
{
    public function __construct(
        public \DateTimeImmutable $date,
        public int $taskId,
        public ?string $title,
        public ?string $description,
        public ?string $state,
        public int $groupId,
    ) {}
}
