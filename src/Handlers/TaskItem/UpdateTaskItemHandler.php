<?php

namespace Dpb\Package\TaskMS\Handlers\TaskItem;

use Dpb\Package\TaskMS\Commands\TaskItem\UpdateTaskItemCommand;
use Dpb\Package\Tasks\Models\TaskItem;

final class UpdateTaskItemHandler
{
    public function __construct(
        private TaskItem $eloquentModel,
    ) {}

    public function handle(UpdateTaskItemCommand $command)
    {
        // update task 
        $task = $this->eloquentModel->find($command->id);
        $task->fill([
            'date' => $command->date,
            'task_id' => $command->taskId,
            'title' => $command->title,
            'description' => $command->description,
            'state' => $command->state,
            'group_id' => $command->groupId,
        ]);
        $task->save();

        return $task;
    }
}
