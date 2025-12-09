<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionAssignment;

use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\UpdateInspectionAssignmentCommand;

final class UpdateInspectionAssignmentHandler
{
    public function __construct(
        private InspectionAssignment $eloquentModel,
    ) {}

    public function handle(UpdateInspectionAssignmentCommand $command)
    {        
        $inspectionAssignment = $this->eloquentModel->find($command->id);
        $inspectionAssignment->fill([
            'inspection_id' => $command->inspectionId,
            'subject_id' => $command->subjectId,
            'subject_type' => $command->subjectType,
        ]);
        $inspectionAssignment->save();

        return $inspectionAssignment;
    }
}
