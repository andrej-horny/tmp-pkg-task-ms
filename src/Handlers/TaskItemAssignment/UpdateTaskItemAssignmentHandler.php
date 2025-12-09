<?php

namespace Dpb\Package\TaskMS\Handlers\TaskItemAssignment;

use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Dpb\Package\TaskMS\Commands\TaskItemAssignment\UpdateTaskItemAssignmentCommand;

final class UpdateTaskItemAssignmentHandler
{
    public function __construct(
        private TaskItemAssignment $eloquentModel,
    ) {}

    public function handle(UpdateTaskItemAssignmentCommand $command)
    {        
        $taskAssignment = $this->eloquentModel->find($command->id);
        $taskAssignment->fill([
            'task_item_id' => $command->taskItemId,
            'assigned_to_id' => $command->assignedToId,
            'assigned_to_type' => $command->assignedToType,
        ]);
        $taskAssignment->save();

        return $taskAssignment;
    }
}
