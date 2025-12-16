<?php

namespace Dpb\Package\TaskMS\Repositories;

use Dpb\Package\TaskMS\Models\TaskAssignment;

final class TaskAssignmentRepository
{
    public function __construct(
        private TaskAssignment $eloquentModel,
    ) {}

    public function findById(int $id)
    {
        return $this->eloquentModel->find($id);
    }

    public function findByTaskId(int $id)
    {
        return $this->eloquentModel->where('task_id', '=', $id)->first();
    }
}
