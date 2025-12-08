<?php

namespace Dpb\Package\TaskMS\Repositories;

use Dpb\Package\TaskMS\Data\Task\TaskAssignmentData;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Task\TaskAssignmentMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\MDpb\Package\TaskMSers\Task\TaskMDpb\Package\TaskMSer;
use Dpb\Package\TaskMS\Models\TaskAssignment;

class TaskAssignmentRepository
{
    public function __construct(
        private TaskAssignment $eloquentModel,
        private TaskMDpb\Package\TaskMSer $taskMDpb\Package\TaskMSer,
        private TaskAssignmentMDpb\Package\TaskMSer $taskAssignmentMDpb\Package\TaskMSer
        ) {}

    public function findById(int $id): ?TaskAssignment
    {
        $model = $this->eloquentModel->findOrFail($id);

        return $model;
    }

    public function save(TaskAssignmentData $taskAssignmentData): ?TaskAssignment
    {
        // create task
        $task = $this->taskMDpb\Package\TaskMSer->toEloquent($taskAssignmentData->task);
        $task->save();

        $taskAssignment = $this->taskAssignmentMDpb\Package\TaskMSer->toEloquent($taskAssignmentData);
        // dd($taskAssignment);
        $taskAssignment->task()->associate($task);
        $taskAssignment->save();

        return $taskAssignment;
    }

    public function push(TaskAssignment $taskAssignment): ?TaskAssignment
    {
        $taskAssignment->push();
        return $taskAssignment;
    }    
}
