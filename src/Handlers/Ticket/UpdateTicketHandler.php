<?php

namespace Dpb\Package\TaskMS\Handlers\Ticket;

use Dpb\Package\TaskMS\Commands\Ticket\UpdateTicketCommand;
use Dpb\Package\Tickets\Models\Ticket;

final class UpdateTicketHandler
{
    public function __construct(
        private Ticket $eloquentModel,
    ) {}

    public function handle(UpdateTicketCommand $command)
    {
        // update ticket 
        $ticket = $this->eloquentModel->find($command->id);
        $ticket->fill([
            'date' => $command->date,
            'description' => $command->description,
            'type_id' => $command->typeId,
            'state' => $command->state,
        ]);
        $ticket->save();

        return $ticket;
    }
}
