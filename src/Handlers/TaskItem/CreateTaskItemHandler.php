<?php

namespace Dpb\Package\TaskMS\Handlers\TaskItem;

use Dpb\Package\TaskMS\Commands\TaskItem\CreateTaskItemCommand;
use Dpb\Package\Tasks\Models\TaskItem;

final class CreateTaskItemHandler
{
    public function __construct(
        private TaskItem $eloquentModel,
    ) {}

    public function handle(CreateTaskItemCommand $command)
    {
        // create task 
        return $this->eloquentModel->create([
            'date' => $command->date,
            'task_id' => $command->taskId,
            'title' => $command->title,
            'description' => $command->description,
            'state' => $command->state,
            'group_id' => $command->groupId,
        ]);
    }
}
