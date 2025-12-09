<?php

namespace Dpb\Package\TaskMS\Commands\Task;

final readonly class UpdateTaskCommand
{
    public function __construct(
        public int $id,
        public \DateTimeImmutable $date,
        public ?string $title,
        public ?string $description,
        public int $groupId,
        public ?string $state,
    ) {}
}
