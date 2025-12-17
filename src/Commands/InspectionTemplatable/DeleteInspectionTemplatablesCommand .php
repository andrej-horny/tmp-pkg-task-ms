<?php

namespace Dpb\Package\TaskMS\Commands\InspectionTemplatable;

final readonly class DeleteInspectionTemplatablesCommand
{
    public function __construct(
        public array $ids,
    ) {}
}
