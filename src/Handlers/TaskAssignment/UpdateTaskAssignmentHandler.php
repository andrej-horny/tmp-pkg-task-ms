<?php

namespace Dpb\Package\TaskMS\Handlers\TaskAssignment;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Commands\TaskAssignment\UpdateTaskAssignmentCommand;
use Dpb\Package\Tasks\Models\Task;

final class UpdateTaskAssignmentHandler
{
    public function __construct(
        private TaskAssignment $eloquentModel,
        private Task $taskModel
    ) {}

    public function handle(UpdateTaskAssignmentCommand $command)
    {        
        // update task 
        $task = $this->taskModel->find($command->task->id);
        $task->fill([
            'date' => $command->task->date,
            'title' => $command->task->title,
            'description' => $command->task->description,
            'group_id' => $command->task->group_id,
            'state' => $command->task->state,
        ]);
        $task->save();
        
        // update task assignment
        $taskAssignment = $this->eloquentModel->find($command->id);
        $taskAssignment->fill([
            'task_id' => $task->id,
            'subject_id' => $command->subject_id,
            'subject_type' => $command->subject_type,
            'source_id' => $command->source_id,
            'source_type' => $command->source_type,
            'assigned_to_id' => $command->assigned_to_id,
            'assigned_to_type' => $command->assigned_to_type,
        ]);
        $taskAssignment->save();

        return $taskAssignment;
    }
}
