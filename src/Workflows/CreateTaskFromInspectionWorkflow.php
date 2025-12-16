<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\Fleet\Entities\MaintenanceGroup;
use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateFromInspectionCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Data\DTOs\CreateTaskAssignmentDTO;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Resolvers\TaskSourceResolver;
use Dpb\Package\TaskMS\Resolvers\TaskSubjectResolver;
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
        private TaskSubjectResolver $taskSubjectResolver,
        private TaskSourceResolver $taskSourceResolver,
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
            $assigneeId = $record->subject->maintenanceGroup?->id;
            $assigneeType = ($assigneeId !== null) ? 'maintenance-group' : null;
            $taskSource = $this->taskSourceResolver->resolve($record->inspection->getMorphClass(), $record->inspection->id);
            $taskSubject = $this->taskSubjectResolver->resolve($record->subject_type, $record->subject_id);
            return $this->taskAssignmentCHdl->handle(
                CreateTaskAssignmentDTO::fromInspectionCommand(
                    new CreateFromInspectionCommand(
                        $task->id,
                        $taskSubject->id,
                        $taskSubject->morphClass,
                        $taskSource->id,
                        $taskSource->morphClass,
                        auth()->user()->id,
                        $assigneeId,
                        $assigneeType
                    )
                )
            );
        });
    }
}
