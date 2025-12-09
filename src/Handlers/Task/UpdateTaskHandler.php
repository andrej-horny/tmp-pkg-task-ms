<?php

namespace Dpb\Package\TaskMS\Handlers\Task;

use Dpb\Package\TaskMS\Commands\Task\UpdateTaskCommand;
use Dpb\Package\Tasks\Models\Task;

final class UpdateTaskHandler
{
    public function __construct(
        private Task $eloquentModel,
    ) {}

    public function handle(UpdateTaskCommand $command)
    {
        // update task 
        $task = $this->eloquentModel->find($command->id);
        $task->fill([
            'date' => $command->date,
            'description' => $command->description,
            'group_id' => $command->groupId,
            'state' => $command->state,
        ]);
        $task->save();

        return $task;
    }
}
