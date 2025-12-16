<?php

namespace Dpb\Package\TaskMS\Handlers\TaskAssignment;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Data\DTOs\CreateTaskAssignmentDTO;

final class CreateTaskAssignmentHandler
{
    public function __construct(
        private TaskAssignment $eloquentModel,
    ) {}

    // public function handle(CreateTaskAssignmentCommand $command)
    // {
    //     return $this->eloquentModel->create([
    //         'task_id' => $command->taskId,
    //         'subject_id' => $command->subjectId,
    //         'subject_type' => $command->subjectType,
    //         'source_id' => $command->sourceId,
    //         'source_type' => $command->sourceType,
    //         'author_id' => $command->authorId,
    //         'assigned_to_id' => $command->assignedToId,
    //         'assigned_to_type' => $command->assignedToType,
    //     ]);
    // }
    public function handle(CreateTaskAssignmentDTO $dto)
    {
        return $this->eloquentModel->create([
            'task_id' => $dto->taskId,
            'subject_id' => $dto->subjectId,
            'subject_type' => $dto->subjectType,
            'source_id' => $dto->sourceId,
            'source_type' => $dto->sourceType,
            'author_id' => $dto->authorId,
            'assigned_to_id' => $dto->assignedToId,
            'assigned_to_type' => $dto->assignedToType,
        ]);
    }
}
