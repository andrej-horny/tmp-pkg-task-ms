<?php

namespace Dpb\Package\TaskMS\States\Ticket;

use Dpb\Package\Tickets\States\TicketState as BaseTicketState;
use Spatie\ModelStates\StateConfig;

abstract class TicketState extends BaseTicketState
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Created::class)
        ;
    }
}
