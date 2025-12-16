<?php

namespace Dpb\Package\TaskMS\Resolvers;

use Dpb\Package\Fleet\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;

class TaskSubjectLabelResolver
{
    public function getLabel(Model $subject): string
    {
        return match (get_class($subject)) {
            Vehicle::class => $subject?->code?->code,
            default => throw new \LogicException('Unknown subject type: ' . get_class($subject)),
        };
    }
}
