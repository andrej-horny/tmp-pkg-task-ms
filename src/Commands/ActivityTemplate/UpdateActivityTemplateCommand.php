<?php

namespace Dpb\Package\TaskMS\Commands\ActivityTemplate;

class UpdateActivityTemplateCommand
{
    public function __construct(
        public int $id,
        public \DateTimeImmutable $date,
        public ?string $title,
        public ?string $description,
        public int $groupId,
        public ?string $state,
    ) {}
}
