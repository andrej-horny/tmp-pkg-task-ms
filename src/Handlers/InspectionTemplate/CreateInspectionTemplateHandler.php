<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionTemplate;

use Dpb\Package\TaskMS\Commands\InspectionTemplate\CreateInspectionTemplateCommand;
use Dpb\Package\Inspections\Models\InspectionTemplate;

final class CreateInspectionTemplateHandler
{
    public function __construct(
        private InspectionTemplate $eloquentModel,
    ) {}

    public function handle(CreateInspectionTemplateCommand $command)
    {
        // create inspection template
        return $this->eloquentModel->create([
            'code' => $command->code,
            'title' => $command->title,
            'description' => $command->description,
            'is_periodic' => $command->is_periodic,
            'treshold_distance' => $command->treshold_distance,
            'first_advance_distance' => $command->first_advance_distance,
            'second_advance_distance' => $command->second_advance_distance,
            'treshold_time' => $command->treshold_time,
            'first_advance_time' => $command->first_advance_time,
            'second_advance_time' => $command->second_advance_time,
        ]);
    }
}
