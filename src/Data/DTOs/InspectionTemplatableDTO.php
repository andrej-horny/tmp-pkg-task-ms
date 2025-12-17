<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class InspectionTemplatableDTO
{
    public function __construct(
        public int $id,
        public string $morphClass,
    ) {}
}
