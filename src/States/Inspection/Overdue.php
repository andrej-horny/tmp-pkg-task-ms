<?php

namespace Dpb\Package\TaskMS\States\Inspection;

use Dpb\Package\TaskMS\States\Inspection\InspectionState;

 class Overdue extends InspectionState
{
    public static $name = "overdue";

    public function label():string {
        return __('inspections/inspection.states.overdue');
    }    
}