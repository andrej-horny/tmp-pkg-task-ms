<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class InspectionSubjectDTO
{
    public function __construct(
        public int $id,
        public string $morphClass,
    ) {}
}
