<?php

namespace Dpb\Package\TaskMS\Handlers\Ticket;

use Dpb\Package\TaskMS\Commands\Ticket\CreateTicketCommand;
use Dpb\Package\Tickets\Models\Ticket;

final class CreateTicketHandler
{
    public function __construct(
        private Ticket $eloquentModel,
    ) {}

    public function handle(CreateTicketCommand $command)
    {
        // create ticket 
        return $this->eloquentModel->create([
            'date' => $command->date,
            'description' => $command->description,
            'type_id' => $command->typeId,
            'state' => $command->state,
        ]);
    }
}
