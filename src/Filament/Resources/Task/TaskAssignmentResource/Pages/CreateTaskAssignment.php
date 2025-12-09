<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class CreateTaskAssignment extends CreateRecord
{
    protected static string $resource = TaskAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task.create_heading');
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create task
            $taskData = $data['task'];
            $task = app(CreateTaskHandler::class)->handle(
                new CreateTaskCommand(
                    new \DateTimeImmutable($taskData['date']),
                    null,
                    $taskData['description'] ?? null,
                    $taskData['group_id'],
                    States\Task\Task\Created::$name,
                )
            );

            // create task assignment
            return app(CreateTaskAssignmentHandler::class)->handle(
                new CreateTaskAssignmentCommand(
                    $task->id,
                    $data['subject_id'],
                    'vehicle',
                    null,
                    null,
                    auth()->user()->id,
                    $data['assigned_to_id'] ?? null,
                    isset($data['assigned_to_id']) ? 'maintenance-group' : null
                )
            );
        });
    }
}
