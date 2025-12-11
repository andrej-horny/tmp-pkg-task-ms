<?php

namespace Dpb\Package\TaskMS\Data\DTOs;

class TaskSubjectDTO
{
    public function __construct(
        public int $id,
        public string $morphClass,
    ) {}
}