<?php

namespace Dpb\Package\TaskMS\Commands\TaskItem;

final readonly class UpdateTaskItemCommand
{
    public function __construct(
        public int $id,
        public \DateTimeImmutable $date,
        public int $taskId,
        public ?string $title,
        public ?string $description,
        public ?string $state,
        public int $groupId,
    ) {}
}
