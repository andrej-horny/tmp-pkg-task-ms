<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class TaskAssigneeDTO
{
    public function __construct(
        public int $id,
        public string $morphClass,
    ) {}
}