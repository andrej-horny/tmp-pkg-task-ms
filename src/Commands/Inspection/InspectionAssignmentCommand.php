<?php

namespace Dpb\Package\TaskMS\Commnads\Inspection;

class InspectionAssignmentCommand
{
    public function __construct(
        public ?int $id,
        public ?InspectionCommand $inspection,
        public int $subject_id,
        public string $subject_type,
        // public int $author_id,
    ) {}

}
