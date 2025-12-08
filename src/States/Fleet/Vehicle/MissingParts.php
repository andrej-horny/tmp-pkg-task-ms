<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class MissingParts extends VehicleState
{
    public static $name = "missing-parts";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.missing-parts');
    }
}