<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Data\DTOs\CreateTaskAssignmentDTO;
use Dpb\Package\TaskMS\Handlers\Inspection\CreateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\CreateInspectionAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Resolvers\TaskSourceResolver;
use Illuminate\Support\Facades\DB;

class CreateDailyMaintenanceWorkflow
{
    public function __construct(
        private CreateInspectionHandler $inspectionCHdl,
        private CreateInspectionAssignmentHandler $inspectionAssignmentCHdl,
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
        private TaskSourceResolver $taskSourceResolver,
    ) {}

    public function handle(
        array $commandsByVehicle
    ) {
        return DB::transaction(function () use ($commandsByVehicle) {
            foreach ($commandsByVehicle as $commands) {
                // create inspection
                $inspection = $this->inspectionCHdl->handle($commands['inspectionCommand']);
                $inspectionAssignment = $this
                    ->inspectionAssignmentCHdl
                    ->handle($commands['inspectionAssignmentCommand']->withRelations($inspection->id));

                // create task
                $task = $this->taskCHdl->handle($commands['taskCommand']);

                // create task assignment
                $taskSource = $this->taskSourceResolver->resolve($inspection->getMorphClass(), $inspection->id);
                $taskAssignment = $this
                    ->taskAssignmentCHdl
                    // ->handle($commands['taskAssignmentCommand']->withRelations($task->id, null, null));
                    ->handle(
                        CreateTaskAssignmentDTO::fromDailyMaintenanceCommand(
                            $commands['taskAssignmentCommand']->withRelations($task->id, $taskSource)
                        )
                    );
            }
        });
    }
}
