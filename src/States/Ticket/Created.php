<?php

namespace Dpb\Package\TaskMS\States\Ticket;

use Dpb\Package\TaskMS\States\Ticket\TicketState;

class Created extends TicketState
{
    public static $name = "created";

    public function label(): string
    {
        return __('tms-ui::tickets/ticket.states.created');
    }
}
