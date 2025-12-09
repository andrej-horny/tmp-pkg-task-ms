<?php

namespace Dpb\Package\TaskMS\Commands\InspectionTemplatable;

final readonly class UpdateInspectionTemplatableCommand
{
    public function __construct(
        public int $id,
        public int $inspectionId,
        public int $templatableId,
        public string $templatableType,
    ) {}

}
