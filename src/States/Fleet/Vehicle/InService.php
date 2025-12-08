<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class InService extends VehicleState
{
    public static $name = "in-service";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.in-service');
    }
}