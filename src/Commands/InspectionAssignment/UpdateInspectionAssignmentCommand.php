<?php

namespace Dpb\Package\TaskMS\Commands\InspectionAssignment;

final readonly class UpdateInspectionAssignmentCommand
{
    public function __construct(
        public int $id,
        public int $inspectionId,
        public int $subjectId,
        public string $subjectType,
    ) {}

}
