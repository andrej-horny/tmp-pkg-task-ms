<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\VehicleModel;
use Dpb\Package\TaskMS\Data\DTOs\InspectionTemplatableDTO;

class InspectionTemplatableResolver
{
    public function resolve(string $type, int $id): InspectionTemplatableDTO
    {
        $model = match ($type) {
            'vehicle-model' => VehicleModel::findOrFail($id),
            default => throw new \InvalidArgumentException("Unknown subject type [$type]"),
        };

        return new InspectionTemplatableDTO(
            id: $model->getKey(),
            morphClass: $model->getMorphClass(),
        );
    }
}
