<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class WaitingForRepairSpot extends VehicleState
{
    public static $name = "waiting-for-repair-spot";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.waiting-for-repair-spot');
    }
}