<?php

namespace Dpb\Package\TaskMS\States\Fleet\Vehicle;

use Dpb\Package\TaskMS\StateTransitions\Fleet\Vehicle\DiscardedToInService;
use Dpb\Package\TaskMS\StateTransitions\Fleet\Vehicle\InServiceToDiscarded;
use Dpb\Package\Fleet\States\VehicleState as BaseVehicleState;
use Spatie\ModelStates\StateConfig;

abstract class VehicleState extends BaseVehicleState
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(InService::class)
            ->allowTransition(InService::class, Discarded::class, InServiceToDiscarded::class)
            ->allowTransition(Discarded::class, InService::class, DiscardedToInService::class)
        ;
    }
}
