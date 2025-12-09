<?php

namespace Dpb\Package\TaskMS\Handlers\Inspection;

use Dpb\Package\TaskMS\Commands\Inspection\UpdateInspectionCommand;
use Dpb\Package\Inspections\Models\Inspection;

final class UpdateInspectionHandler
{
    public function __construct(
        private Inspection $eloquentModel,
    ) {}

    public function handle(UpdateInspectionCommand $command)
    {
        // update inspection 
        $inspection = $this->eloquentModel->find($command->id);
        $inspection->fill([
            'date' => $command->date,
            'template_id' => $command->templateId,
            'state' => $command->state,
        ]);
        $inspection->save();

        return $inspection;
    }
}
