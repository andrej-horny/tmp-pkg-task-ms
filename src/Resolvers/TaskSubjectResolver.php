<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Data\DTOs\TaskSubjectDTO;

class TaskSubjectResolver
{
    public function resolve(string $type, int $id): TaskSubjectDTO
    {
        $model = match ($type) {
            'vehicle' => Vehicle::findOrFail($id),
            default => throw new \InvalidArgumentException("Unknown subject type [$type]"),
        };

        return new TaskSubjectDTO(
            id: $model->getKey(),
            morphClass: $model->getMorphClass(),
        );
    }
}