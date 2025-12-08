<?php

namespace Dpb\Package\TaskMS\States\Inspection;

use Dpb\Package\TaskMS\States\Inspection\InspectionState;

 class Upcoming extends InspectionState
{
    public static $name = "upcoming";

    public function label():string {
        return __('inspections/inspection.states.upcoming');
    }    
}