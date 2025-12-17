<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\InspectionTemplate\UpdateInspectionTemplateCommand;
use Dpb\Package\TaskMS\Handlers\InspectionTemplatable\UpdateInspectionTemplatableHandler;
use Dpb\Package\TaskMS\Handlers\InspectionTemplate\UpdateInspectionTemplateHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateInspectionTemplateWorkflow
{
    public function __construct(
        private UpdateInspectionTemplateHandler $inspectionTemplateUHdl,
        private UpdateInspectionTemplatableHandler $inspectionTemplatableUHdl,
    ) {}

    public function handle(UpdateInspectionTemplateCommand $inspectionTemplateUCmd, array $inspectionTemplatablesUCmds): Model
    {
        return DB::transaction(function () use ($inspectionTemplateUCmd, $inspectionTemplatablesUCmds) {
            // update inspection template
            $inspectionTemplate = $this->inspectionTemplateUHdl->handle($inspectionTemplateUCmd);

            // update inspection templatables
            // delete all existing for this template
            // create new
            foreach ($inspectionTemplatablesUCmds as $cmd) {
                $this->inspectionTemplatableUHdl->handle($cmd->withTemplateId($inspectionTemplate->id));
            }
            return $inspectionTemplate;
        });
    }
}
