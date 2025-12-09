<?php

namespace Dpb\Package\TaskMS\Handlers\TaskAssignment;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Commands\TaskAssignment\UpdateTaskAssignmentCommand;

final class UpdateTaskAssignmentHandler
{
    public function __construct(
        private TaskAssignment $eloquentModel,
    ) {}

    public function handle(UpdateTaskAssignmentCommand $command)
    {        
        $taskAssignment = $this->eloquentModel->find($command->id);
        $taskAssignment->fill([
            'task_id' => $command->taskId,
            'subject_id' => $command->subjectId,
            'subject_type' => $command->subjectType,
            'source_id' => $command->sourceId,
            'source_type' => $command->sourceType,
            'assigned_to_id' => $command->assignedToId,
            'assigned_to_type' => $command->assignedToType,
        ]);
        $taskAssignment->save();

        return $taskAssignment;
    }
}
