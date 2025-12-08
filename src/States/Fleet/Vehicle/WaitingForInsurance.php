<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class WaitingForInsurance extends VehicleState
{
    public static $name = "waiting-for-insurance";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.waiting-for-insurance');
    }
}