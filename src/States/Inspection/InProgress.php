<?php

namespace Dpb\Package\TaskMS\States\Inspection;

use Dpb\Package\TaskMS\States\Inspection\InspectionState;

 class InProgress extends InspectionState
{
    public static $name = "in-progress";

    public function label():string {
        return __('inspections/inspection.states.in-progress');
    }    
}