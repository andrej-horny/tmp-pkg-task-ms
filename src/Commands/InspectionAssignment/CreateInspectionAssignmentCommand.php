<?php

namespace Dpb\Package\TaskMS\Commands\InspectionAssignment;

final readonly class CreateInspectionAssignmentCommand
{
    public function __construct(
        public ?int $inspectionId,
        public int $subjectId,
        public string $subjectType,
    ) {}

    public function withRelations(int $inspectionId): self
    {
        return new self(
            $inspectionId,
            $this->subjectId,
            $this->subjectType,
        );
    }      
}
