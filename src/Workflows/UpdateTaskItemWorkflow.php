<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\TaskItem\UpdateTaskItemCommand;
use Dpb\Package\TaskMS\Commands\TaskItemAssignment\UpdateTaskItemAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\TaskItem\UpdateTaskItemHandler;
use Dpb\Package\TaskMS\Handlers\TaskItemAssignment\UpdateTaskItemAssignmentHandler;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateTaskItemWorkflow
{
    public function __construct(
        private UpdateTaskItemHandler $tiUHdl,
        private UpdateTaskItemAssignmentHandler $tiaUHdl,
    ) {}

    public function execute(int $taskItemId, int $taskId, array $data): Model
    {
        return DB::transaction(function () use ($taskItemId, $taskId, $data) {
            // update task item
            $taskItem = $this->tiUHdl->handle(
                new UpdateTaskItemCommand(
                    $taskItemId,
                    new \DateTimeImmutable($data['date']),
                    $taskId,
                    null,
                    $data['description'] ?? null,
                    $data['state'],
                    $data['group_id']
                )
            );

            // update task item assignment
            $tiaId = TaskItemAssignment::whereBelongsTo($taskItem)->first()->id;
            return $this->tiaUHdl->handle(
                new UpdateTaskItemAssignmentCommand(
                    $tiaId,
                    $taskItemId,
                    $data['assigned_to'] ?? null,
                    isset($data['assigned_to']) ? 'maintenance-group' : null,
                )
            );
        });
    }
}
