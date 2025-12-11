<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionTemplatable;

use Dpb\Package\TaskMS\Commands\InspectionTemplatable\CreateInspectionTemplatableCommand;
use Dpb\Package\TaskMS\Models\InspectionTemplatable;

final class CreateInspectionTemplatableHandler
{
    public function __construct(
        private InspectionTemplatable $eloquentModel,
    ) {}

    public function handle(CreateInspectionTemplatableCommand $command)
    {
        // create inspection template
        return $this->eloquentModel->create([
            'template_id' => $command->templateId,
            'templatable_id' => $command->templatableId,
            'templatable_type' => $command->templatableType,
        ]);
    }
}
