<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

use Dpb\Package\TaskMS\Data\DTOs\TaskSourceDTO;

class CreateFromInspectionCommand
{
    public function __construct(
        public ?int $taskId,
        public ?int $subjectId,
        public ?string $subjectType,
        public ?int $sourceId,
        public ?string $sourceType,
        public int $authorId,
        public ?int $assignedToId,
        public ?string $assignedToType,
    ) {}

}
