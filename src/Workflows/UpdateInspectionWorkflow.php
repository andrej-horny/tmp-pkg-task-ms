<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Inspection\UpdateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\UpdateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Inspection\UpdateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\UpdateInspectionAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
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
}
