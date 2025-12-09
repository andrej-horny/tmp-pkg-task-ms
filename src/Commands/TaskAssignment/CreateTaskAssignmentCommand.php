<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

class CreateTaskAssignmentCommand
{
    public function __construct(
        public int $taskId,
        public int $subjectId,
        public string $subjectType,
        public ?int $sourceId,
        public ?string $sourceType,
        public int $authorId,
        public ?int $assignedToId,
        public ?string $assignedToType,
    ) {}
}
