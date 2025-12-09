<?php

namespace Dpb\Package\TaskMS\Commands\Task;

final readonly class CreateTaskCommand
{
    public function __construct(
        public \DateTimeImmutable $date,
        public ?string $title,
        public ?string $description,
        public int $groupId,
        public ?string $state,
        public int $placeOfOriginId,
    ) {}
}
