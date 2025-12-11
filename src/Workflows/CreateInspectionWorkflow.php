<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Inspection\CreateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\CreateInspectionAssignmentHandler;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class CreateInspectionWorkflow
{
    public function __construct(
        private CreateInspectionHandler $inspectionCHdl,
        private CreateInspectionAssignmentHandler $inspectionAssignmentCHdl,
    ) {}

    public function handle(
        CreateInspectionCommand $inspectionCCmd,
        CreateInspectionAssignmentCommand $inspectionAssignmentCCmd,
    ): Model {
        return DB::transaction(function () use ($inspectionCCmd, $inspectionAssignmentCCmd) {
            // create inspection
            $inspection = $this->inspectionCHdl->handle($inspectionCCmd);
            // create inspection assignment
            $inspectionAssignment = $this
                ->inspectionAssignmentCHdl
                ->handle($inspectionAssignmentCCmd->withRelations($inspection->id));

            return $inspectionAssignment;
        });
    }
}
