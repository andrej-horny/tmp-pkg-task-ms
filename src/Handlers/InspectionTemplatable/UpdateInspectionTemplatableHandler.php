<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionTemplatable;

use Dpb\Package\TaskMS\Commands\InspectionTemplatable\UpdateInspectionTemplatableCommand;
use Dpb\Package\TaskMS\Models\InspectionTemplatable as ModelsInspectionTemplatable;

final class UpdateInspectionTemplatableHandler
{
    public function __construct(
        private ModelsInspectionTemplatable $eloquentModel,
    ) {}

    public function handle(UpdateInspectionTemplatableCommand $command)
    {
        // update inspection template
        $inspection = $this->eloquentModel->find($command->id);
        $inspection->fill([
            'template_id' => $command->templateId,
            'templatable_id' => $command->templatableId,
            'templatable_type' => $command->templatableType,
        ]);
        $inspection->save();

        return $inspection;
    }
}
