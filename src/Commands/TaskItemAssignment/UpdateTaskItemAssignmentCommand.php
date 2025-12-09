<?php

namespace Dpb\Package\TaskMS\Commands\TaskItemAssignment;

class UpdateTaskItemAssignmentCommand
{
    public function __construct(
        public int $id,
        public int $taskItemId,
        public ?int $assignedToId,
        public ?string $assignedToType,
    ) {}
}
