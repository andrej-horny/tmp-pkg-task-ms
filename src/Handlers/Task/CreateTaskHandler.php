<?php

namespace Dpb\Package\TaskMS\Handlers\Task;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\Tasks\Models\Task;

final class CreateTaskHandler
{
    public function __construct(
        private Task $eloquentModel,
    ) {}

    public function handle(CreateTaskCommand $command)
    {
        // create task 
        return $this->eloquentModel->create([
            'date' => $command->date,
            'description' => $command->description,
            'group_id' => $command->groupId,
            'state' => $command->state,
            'place_of_origin_id' => $command->placeOfOriginId,
        ]);
    }
}
