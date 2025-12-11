<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tasks\Models\TaskGroup;
use Illuminate\Support\Facades\DB;

class CreateTaskFromInspectionWorkflow
{
    public function __construct(
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
    ) {}

    public function createFromInspectionAssignment(InspectionAssignment $record): Model
    {
        return DB::transaction(function () use ($record) {
            // create task
            $taskGroupId = TaskGroup::byCode('inspection')->first()->id;
            $placeOfOriginId = PlaceOfOrigin::byUri('during-maintenance')->first()?->id;
            $task = $this->taskCHdl->handle(
                new CreateTaskCommand(
                    new \DateTimeImmutable(),
                    null,
                    null,
                    $taskGroupId,
                    States\Task\Task\Created::$name,
                    $placeOfOriginId
                )
            );

            // create task assignment
            // dd($placeOfOriginId);
            return $this->taskAssignmentCHdl->handle(
                new CreateTaskAssignmentCommand(
                    $task->id,
                    $record->subject_id,
                    'vehicle',
                    $record->inspection->id,
                    $record->inspection->getMorphClass(),
                    auth()->user()->id,
                    $record->subject->maintenanceGroup->id,
                    $record->subject->maintenanceGroup->getMorphClass()
                )
            );
        });
    }
}
