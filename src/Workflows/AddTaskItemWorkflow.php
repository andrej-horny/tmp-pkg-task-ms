<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\TaskItem\CreateTaskItemCommand;
use Dpb\Package\TaskMS\Commands\TaskItemAssignment\CreateTaskItemAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\TaskItem\CreateTaskItemHandler;
use Dpb\Package\TaskMS\Handlers\TaskItemAssignment\CreateTaskItemAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class AddTaskItemWorkflow
{
    public function __construct(
        private CreateTaskItemHandler $tiCHdl,
        private CreateTaskItemAssignmentHandler $tiaCHdl,
    ) {}

    public function execute(int $taskId, array $data): Model
    {
        return DB::transaction(function () use ($taskId, $data) {
            // create task item
            $taskItem = $this->tiCHdl->handle(
                new CreateTaskItemCommand(
                    new \DateTimeImmutable($data['date']),
                    $taskId,
                    null,
                    $data['description'] ?? null,
                    States\Task\TaskItem\Created::$name,
                    $data['group_id']
                )
            );

            // create task item assignment
            return $this->tiaCHdl->handle(
                new CreateTaskItemAssignmentCommand(
                    $taskItem->id,
                    $data['assigned_to'] ?? null,
                    isset($data['assigned_to']) ? 'maintenance-group' : null,
                    auth()->user()->id,
                )
            );
        });
    }
}
