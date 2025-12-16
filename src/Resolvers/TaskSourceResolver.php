<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Inspections\Models\Inspection;
use Dpb\Package\TaskMS\Data\DTOs\TaskSourceDTO;
use Dpb\Package\TaskMS\Data\DTOs\TaskSubjectDTO;
use Dpb\Package\Tickets\Models\Ticket;

class TaskSourceResolver
{
    public function resolve(string $type, int $id): TaskSourceDTO
    {
        $model = match ($type) {
            'ticket' => Ticket::findOrFail($id),
            'inspection' => Inspection::findOrFail($id),
            default => throw new \InvalidArgumentException("Unknown subject type [$type]"),
        };

        return new TaskSourceDTO(
            id: $model->getKey(),
            morphClass: $model->getMorphClass(),
        );
    }
}
