<?php

namespace Dpb\Package\TaskMS\Mappers;

use Dpb\Package\Tasks\Models\TaskGroup;
use Dpb\Package\Tickets\Models\TicketType;

class TicketTypeToTaskGroupMapper
{
    public function __construct(
        private TicketType $ticketType,
        private TaskGroup $taskGroup,
    ) {}

    public function mapTicketTypeIdToTaskGroupId(int $typeId): ?int
    {
        $ticketCode = $this->ticketType->find($typeId)->code;
        return $this->taskGroup->byCode($ticketCode)->first()?->id;
    }
}
