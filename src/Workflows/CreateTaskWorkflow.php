<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTaskWorkflow
{
    public function __construct(
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
    ) {}

    public function handle(
        CreateTaskCommand $taskCCmd,
        CreateTaskAssignmentCommand $taskAssignmentCCmd,
    ): Model {
        return DB::transaction(function () use ($taskCCmd, $taskAssignmentCCmd) {
            // create task
            $task = $this->taskCHdl->handle($taskCCmd);
            // create task assignment
            $taskAssignment = $this
                ->taskAssignmentCHdl
                ->handle($taskAssignmentCCmd->withRelations($task->id, null, null));

            return $taskAssignment;
        });
    }
}
