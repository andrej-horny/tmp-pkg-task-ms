<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\UpdateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\UpdateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\UpdateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\UpdateTaskAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class UpdateTaskWorkflow
{
    public function __construct(
        private UpdateTaskHandler $taskCHdl,
        private UpdateTaskAssignmentHandler $taskAssignmentCHdl,
    ) {}

    public function handle(
        UpdateTaskCommand $taskCCmd,
        UpdateTaskAssignmentCommand $taskAssignmentCCmd,
    ): Model {
        return DB::transaction(function () use ($taskCCmd, $taskAssignmentCCmd) {
            // create task
            $task = $this->taskCHdl->handle($taskCCmd);
            // create task assignment
            $taskAssignment = $this
                ->taskAssignmentCHdl
                ->handle($taskAssignmentCCmd);

            return $taskAssignment;
        });
    }

    public function createFromForm(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create task
            $task = $this->taskCHdl->handle(
                new UpdateTaskCommand(
                    new \DateTimeImmutable($data['date']),
                    $data['template_id'] ?? null,
                    States\Task\Upcoming::$name,
                )
            );

            // create task assignment
            return $this->taskAssignmentCHdl->handle(
                new UpdateTaskAssignmentCommand(
                    $task->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
