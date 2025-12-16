<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

use Dpb\Package\TaskMS\Data\DTOs\TaskSourceDTO;

class CreateFromTicketCommand
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

    public function withRelations(int $taskId, TaskSourceDTO $source): self
    {
        return new self(
            $taskId,
            $this->subjectId,
            $this->subjectType,
            $source->id,
            $source->morphClass,
            $this->authorId,
            $this->assignedToId,
            $this->assignedToType,
        );
    }
}
