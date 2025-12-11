<?php

namespace Dpb\Package\TaskMS\Commands\TaskItemAssignment;

class CreateTaskItemAssignmentCommand
{
    public function __construct(
        public ?int $taskItemId,
        public ?int $assignedToId,
        public ?string $assignedToType,
        public int $authorId,
    ) {}

    public function withRelations(int $taskItemId): self
    {
        return new self(
            $taskItemId,
            $this->assignedToId,
            $this->assignedToType,
            $this->authorId,
        );
    }
}
