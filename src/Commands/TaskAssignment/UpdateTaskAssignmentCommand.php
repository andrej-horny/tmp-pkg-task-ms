<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

class UpdateTaskAssignmentCommand
{
    public function __construct(
        public int $id,
        public int $taskId,
        public int $subjectId,
        public string $subjectType,
        public ?int $sourceId,
        public ?string $sourceType,
        public ?int $assignedToId,
        public ?string $assignedToType,
    ) {}
}
