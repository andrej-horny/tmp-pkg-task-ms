<?php

namespace Dpb\Package\TaskMS\Handlers\InspectionTemplatable;

use Dpb\Package\TaskMS\Commands\InspectionTemplatable\DeleteInspectionTemplatablesCommand;
use Dpb\Package\TaskMS\Models\InspectionTemplatable;

final class DeleteInspectionTemplatableHandler
{
    public function __construct(
        private InspectionTemplatable $eloquentModel,
    ) {}

    public function handle(DeleteInspectionTemplatablesCommand $command)
    {
        // update inspection template
        $this->eloquentModel->whereIn('id', $command->ids)->delete();

    }
}
