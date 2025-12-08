<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class UnderRepair extends VehicleState
{
    public static $name = "under-repair";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.under-repair');
    }
}