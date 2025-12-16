<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateFromDailyMaintenanceCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateFromInspectionCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateFromTicketCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;

class CreateTaskAssignmentDTO
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

    // Factory methods to adapt commands
    public static function fromTicket(CreateFromTicketCommand $command): self
    {
        return new self(
            $command->taskId,
            $command->subjectId,
            $command->subjectType,
            $command->sourceId,
            $command->sourceType,
            $command->authorId,
            $command->assignedToId,
            $command->assignedToType,
        );
    }

    public static function fromInspectionCommand(CreateFromInspectionCommand $command): self
    {
        return new self(
            $command->taskId,
            $command->subjectId,
            $command->subjectType,
            $command->sourceId,
            $command->sourceType,
            $command->authorId,
            $command->assignedToId,
            $command->assignedToType,
        );
    }

    public static function fromDailyMaintenanceCommand(CreateFromDailyMaintenanceCommand $command): self
    {
        return new self(
            $command->taskId,
            $command->subjectId,
            $command->subjectType,
            $command->sourceId,
            $command->sourceType,
            $command->authorId,
            $command->assignedToId,
            $command->assignedToType,
        );
    }

    public static function fromCreateCommand(CreateTaskAssignmentCommand $command): self
    {
        return new self(
            $command->taskId,
            $command->subjectId,
            $command->subjectType,
            $command->sourceId,
            $command->sourceType,
            $command->authorId,
            $command->assignedToId,
            $command->assignedToType,
        );
    }

}
