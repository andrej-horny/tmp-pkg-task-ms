<?php

namespace Dpb\Package\TaskMS\Workflows;

use Dpb\Package\TaskMS\Commands\InspectionTemplate\CreateInspectionTemplateCommand;
use Dpb\Package\TaskMS\Handlers\InspectionTemplatable\CreateInspectionTemplatableHandler;
use Dpb\Package\TaskMS\Handlers\InspectionTemplate\CreateInspectionTemplateHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateInspectionTemplateWorkflow
{
    public function __construct(
        private CreateInspectionTemplateHandler $inspectionTemplateCHdl,
        private CreateInspectionTemplatableHandler $inspectionTemplatableCHdl,
    ) {}

    public function handle(CreateInspectionTemplateCommand $inspectionTemplateCCmd, array $inspectionTemplatablesCCmds): Model
    {
        return DB::transaction(function () use ($inspectionTemplateCCmd, $inspectionTemplatablesCCmds) {
            // create inspection template
            $inspectionTemplate = $this->inspectionTemplateCHdl->handle($inspectionTemplateCCmd);

            // create inspection templatable
            foreach ($inspectionTemplatablesCCmds as $cmd) {
                $this->inspectionTemplatableCHdl->handle($cmd->withTemplateId($inspectionTemplate->id));
            }            
            return $inspectionTemplate;
        });
    }
}
