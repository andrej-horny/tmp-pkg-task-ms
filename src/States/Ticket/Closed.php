<?php

namespace Dpb\Package\TaskMS\States\Ticket;

use Dpb\Package\TaskMS\States\Ticket\TicketState;

 class Closed extends TicketState
{
    public static $name = "closed";

    public function label():string {
        return __('tms-ui::tickets/ticket.states.closed');
    }    
}