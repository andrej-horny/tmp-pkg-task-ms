<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\TaskMS\Data\DTOs\TaskAssigneeDTO;

class TaskAssigneeResolver
{
    public function resolve(string $type, int $id): TaskAssigneeDTO
    {
        $model = match ($type) {
            'maintenance-group' => MaintenanceGroup::findOrFail($id),
            default => throw new \InvalidArgumentException("Unknown subject type [$type]"),
        };

        return new TaskAssigneeDTO(
            id: $model->getKey(),
            morphClass: $model->getMorphClass(),
        );
    }
}