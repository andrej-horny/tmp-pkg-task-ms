<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Inspection\CreateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\CreateInspectionAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tasks\Models\TaskGroup;
use Illuminate\Support\Facades\DB;

class CreateDailyMaintenanceWorkflow
{
    public function __construct(
        private CreateInspectionHandler $inspectionCHdl,
        private CreateInspectionAssignmentHandler $inspectionAssignmentCHdl,
        private CreateTaskHandler $taskCHdl,
        private CreateTaskAssignmentHandler $taskAssignmentCHdl,
    ) {}

    public function handle(
        CreateInspectionCommand $inspectionCCmd, 
        CreateInspectionAssignmentCommand $iaCCmd,

        )
    {
        return DB::transaction(function () use ($inspectionCCmd, $iaCCmd, $taskCCmd, $taskAssignmentsCommands) {
            // create inspection 
            $inspection = $this->inspectionCHdl->handle($inspectionCCmd);

            // create inspection templatable
            foreach ($inspectionTemplatablesCCmds as $cmd) {
                $this->inspectionTemplatableCHdl->handle($cmd->withTemplateId($inspectionTemplate->id));
            }            
            return $inspectionTemplate;
        });
    }

    public function createFromForm(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['vehicles'] as $vehicleId) {
                // create inspection
                $inspection = $this->inspectionCHdl->handle(
                    new CreateInspectionCommand(
                        new \DateTimeImmutable($data['date']),
                        $data['inspection-template'] ?? null,
                        States\Inspection\Upcoming::$name,
                    )
                );

                // create inspection assignment
                $inspectionAssignment = $this->inspectionAssignmentCHdl->handle(
                    new CreateInspectionAssignmentCommand(
                        $inspection->id,
                        $vehicleId,
                        'vehicle',
                    )
                );

                // create task
                $taskGroupId = TaskGroup::byCode('daily-maintenance')->first()->id;
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
                $taskAssignment = $this->taskAssignmentCHdl->handle(
                    new CreateTaskAssignmentCommand(
                        $task->id,
                        $vehicleId,
                        'vehicle',
                        $inspection->id,
                        $inspection->getMorphClass(),
                        auth()->user()->id,
                        null, //$record->subject->maintenanceGroup->id,
                        null //record->subject->maintenanceGroup->getMorphClass()
                    )
                );
            }
        });
    }
}
