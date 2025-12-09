<?php

namespace Dpb\Package\TaskMS\Commands\Inspection;

final readonly class CreateInspectionCommand
{
    public function __construct(
        public \DateTimeImmutable $date,
        public int $templateId,
        public string $state,
    ) {}
}
