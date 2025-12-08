<?php

namespace Dpb\Package\TaskMS\Commands\TaskAssignment;

class CreateTaskAssignmentCommand
{
    public function __construct(
        public ?int $id,
        public TaskCommand $task,
        public int $subject_id,
        public string $subject_type,
        public ?int $source_id,
        public ?string $source_type,
        public int $author_id,
        public ?int $assigned_to_id,
        public ?string $assigned_to_type,
    ) {}
}
