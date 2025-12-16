<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class TaskAssigneeDTO
{
    public function __construct(
        public int|null $id,
        public string|null $morphClass,

    ) {}
}
