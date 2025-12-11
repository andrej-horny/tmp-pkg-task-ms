<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Data\DTOs\TicketSubjectDTO;

class TicketSubjectResolver
{
    public function resolve(string $type, int $id): TicketSubjectDTO
    {
        $model = match ($type) {
            'vehicle' => Vehicle::findOrFail($id),
            default => throw new \InvalidArgumentException("Unknown subject type [$type]"),
        };

        return new TicketSubjectDTO(
            id: $model->getKey(),
            morphClass: $model->getMorphClass(),
        );
    }
}