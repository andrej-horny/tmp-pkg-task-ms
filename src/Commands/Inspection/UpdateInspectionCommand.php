<?php

namespace Dpb\Package\TaskMS\Commands\Inspection;

final readonly class UpdateInspectionCommand
{
    public function __construct(
        public ?int $id,
        public \DateTimeImmutable $date,
        public int $templateId,
        public string $state,
    ) {}
}
