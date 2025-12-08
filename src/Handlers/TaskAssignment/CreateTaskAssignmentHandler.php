<?php

namespace Dpb\Package\TaskMS\Handlers\TaskAssignment;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\Tasks\Models\Task;

final class CreateTaskAssignmentHandler
{
    public function __construct(
        private TaskAssignment $eloquentModel,
        private Task $taskModel
    ) {}

    public function handle(CreateTaskAssignmentCommand $command)
    {
        // create task 
        $task = $this->taskModel->create([
            'date' => $command->task->date,
            'title' => $command->task->title,
            'description' => $command->task->description,
            'group_id' => $command->task->group_id,
            'state' => $command->task->state,
        ]);

        // create task assignment
        return $this->eloquentModel->create([
            'task_id' => $task->id,
            'subject_id' => $command->subject_id,
            'subject_type' => $command->subject_type,
            'source_id' => $command->source_id,
            'source_type' => $command->source_type,
            'author_id' => $command->author_id,
            '$assigned_to_id' => $command->assigned_to_id,
            '$assigned_to_type' => $command->assigned_to_type,
        ]);
    }
}
