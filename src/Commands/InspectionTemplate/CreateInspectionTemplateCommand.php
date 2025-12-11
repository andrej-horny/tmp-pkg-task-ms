<?php

namespace Dpb\Package\TaskMS\Commands\InspectionTemplate;

final readonly class CreateInspectionTemplateCommand
{
    public function __construct(
        public string $code,
        public string $title,
        public ?string $description,
        public bool $is_periodic,
        public ?int $treshold_distance,
        public ?int $first_advance_distance,
        public ?int $second_advance_distance,
        public ?int $treshold_time,
        public ?int $first_advance_time,
        public ?int $second_advance_time,   
    ) {}
}
