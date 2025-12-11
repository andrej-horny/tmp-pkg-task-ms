<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Inspection\UpdateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\UpdateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Inspection\UpdateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\UpdateInspectionAssignmentHandler;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class UpdateInspectionWorkflow
{
    public function __construct(
        private UpdateInspectionHandler $inspectionUHdl,
        private UpdateInspectionAssignmentHandler $inspectionAssignmentUHdl,
    ) {}

    public function handle(
        UpdateInspectionCommand $inspectionUCmd,
        UpdateInspectionAssignmentCommand $inspectionAssignmentUCmd,
    ): Model {
        return DB::transaction(function () use ($inspectionUCmd, $inspectionAssignmentUCmd) {
            // update inspection
            $inspection = $this->inspectionUHdl->handle($inspectionUCmd);
            // update inspection assignment
            $inspectionAssignment = $this->inspectionAssignmentUHdl->handle($inspectionAssignmentUCmd);

            return $inspectionAssignment;
        });
    }    

    public function updateFromForm(InspectionAssignment $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            // update inspection
            $inspection = $this->inspectionUHdl->handle(
                new UpdateInspectionCommand(
                    $record->inspection->id,
                    new \DateTimeImmutable($data['date']),
                    $data['template_id'] ?? null,
                    States\Inspection\Upcoming::$name,
                )
            );

            // update inspection assignment
            return $this->inspectionAssignmentUHdl->handle(
                new UpdateInspectionAssignmentCommand(
                    $record->id,
                    $inspection->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
