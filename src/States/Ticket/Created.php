<?php

namespace App\States\Ticket;

use App\States\Ticket\TicketState;

class Created extends TicketState
{
    public static $name = "created";

    public function label(): string
    {
        return __('tickets/ticket.states.created');
    }
}
