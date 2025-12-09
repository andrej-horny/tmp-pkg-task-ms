<?php

namespace Dpb\Package\TaskMS\Commands\ActivityTemplate;

class CreateActivityTemplateCommand
{
    public function __construct(
        public \DateTimeImmutable $date,
        public ?string $title,
        public ?string $description,
        public int $groupId,
        public ?string $state,
    ) {}
}
