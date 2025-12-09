<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionAssignment;

use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;

final class CreateInspectionAssignmentHandler
{
    public function __construct(
        private InspectionAssignment $eloquentModel,
    ) {}

    public function handle(CreateInspectionAssignmentCommand $command)
    {
        return $this->eloquentModel->create([
            'inspection_id' => $command->inspectionId,
            'subject_id' => $command->subjectId,
            'subject_type' => $command->subjectType,
        ]);
    }
}
