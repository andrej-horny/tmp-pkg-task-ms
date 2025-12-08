<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class Discarded extends VehicleState
{
    public static $name = "discarded";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.discarded');
    }    
}