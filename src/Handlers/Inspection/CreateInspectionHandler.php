<?php

namespace Dpb\Package\TaskMS\Handlers\Inspection;

use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\Inspections\Models\Inspection;

final class CreateInspectionHandler
{
    public function __construct(
        private Inspection $eloquentModel,
    ) {}

    public function handle(CreateInspectionCommand $command)
    {
        // create inspection 
        return $this->eloquentModel->create([
            'date' => $command->date,
            'template_id' => $command->templateId,
            'state' => $command->state,
        ]);
    }
}
