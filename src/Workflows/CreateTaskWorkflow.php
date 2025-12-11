<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
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

    public function createFromForm(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create task
            $task = $this->taskCHdl->handle(
                new CreateTaskCommand(
                    new \DateTimeImmutable($data['date']),
                    $data['template_id'] ?? null,
                    States\Task\Upcoming::$name,
                )
            );

            // create task assignment
            return $this->taskAssignmentCHdl->handle(
                new CreateTaskAssignmentCommand(
                    $task->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
