<?php

namespace Dpb\Package\TaskMS\Handlers\TaskItemAssignment;

use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Dpb\Package\TaskMS\Commands\TaskItemAssignment\CreateTaskItemAssignmentCommand;

final class CreateTaskItemAssignmentHandler
{
    public function __construct(
        private TaskItemAssignment $eloquentModel,
    ) {}

    public function handle(CreateTaskItemAssignmentCommand $command)
    {
        return $this->eloquentModel->create([
            'task_item_id' => $command->taskItemId,
            'assigned_to_id' => $command->assignedToId,
            'assigned_to_type' => $command->assignedToType,
            'author_id' => $command->authorId,
        ]);
    }
}
