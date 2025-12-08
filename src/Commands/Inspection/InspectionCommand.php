<?php

namespace Dpb\Package\TaskMS\Commnads\Inspection;

class InspectionCommand
{
    public function __construct(
        public ?int $id,
        public \DateTimeImmutable $date,
        public int $template_id,
        public string $state,
    ) {}
}
