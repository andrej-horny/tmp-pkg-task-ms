<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class WarrantyClaim extends VehicleState
{
    public static $name = "warranty-claim";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.warranty-claim');
    }
}