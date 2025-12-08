<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Commands\TaskAssignment\TaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\UpdateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\UpdateTaskAssignmentHandler;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;

class EditTaskAssignment extends EditRecord
{
    protected static string $resource = TaskAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task.update_heading', ['title' => $this->record->getTitleAttribute()]);
    }  
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $data['subject_id'] = Dpb\Package\TaskMS(TaskAssignment::class)->whereBelongsTo($this->record)->first()?->subject?->id;

        // task group
        $data['task']['date'] = $this->record->task->date;
        $data['task']['group_id'] = $this->record->task->group_id;
        $data['task']['description'] = $this->record->task->description;

        // activities
        // $activities = app(ActivityService::class)->getActivities($this->record->task)->toArray();
        // $data['activities'] = $activities;
        // dd($activities);
        return $data;
    }
  
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $taskData = $data['task'];
        $taskCmd = new TaskCommand(
            $record->task->id,
            new \DateTimeImmutable($taskData['date']),
            null,
            $taskData['description'] ?? null,
            $taskData['group_id'],
            States\Task\Task\Created::$name,
        );
        $taCmd = new UpdateTaskAssignmentCommand(
            $record->id,
            $taskCmd,
            $data['subject_id'],
            'vehicle',
            null,
            null,
            $data['assigned_to_id'] ?? null,
            isset($data['assigned_to_id']) ? 'maintenance-group' : null
        );

        return app(UpdateTaskAssignmentHandler::class)->handle($taCmd);
    }
}
