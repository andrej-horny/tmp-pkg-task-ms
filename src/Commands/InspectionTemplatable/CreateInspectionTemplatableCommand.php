<?php

namespace Dpb\Package\TaskMS\Commands\InspectionTemplatable;

final readonly class CreateInspectionTemplatableCommand
{
    public function __construct(
        public int $inspectionId,
        public int $templatableId,
        public string $templatableType,
    ) {}

}
