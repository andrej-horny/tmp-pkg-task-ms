<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Commands\TaskAssignment\TaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;

class CreateTaskAssignment extends CreateRecord
{
    protected static string $resource = TaskAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        $taskData = $data['task'];
        $taskCmd = new TaskCommand(
            null,
            new \DateTimeImmutable($taskData['date']),
            null,
            $taskData['description'] ?? null,
            $taskData['group_id'],
            States\Task\Task\Created::$name,
        );

        $taCmd = new CreateTaskAssignmentCommand(
            null,
            $taskCmd,
            $data['subject_id'],
            'vehicle',
            null,
            null,
            auth()->user()->id,
            $data['assigned_to_id'] ?? null,
            isset($data['assigned_to_id']) ? 'maintenance-group' : null
        );

        return app(CreateTaskAssignmentHandler::class)->handle($taCmd);
    }
}
