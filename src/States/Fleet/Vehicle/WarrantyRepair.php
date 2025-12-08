<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

 class WarrantyRepair extends VehicleState
{
    public static $name = "Warranty-repair";

    public function label():string {
        return __('tms-ui::fleet/vehicle.states.warranty-repair');
    }
}