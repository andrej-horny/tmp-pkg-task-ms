<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource;
use Dpb\Package\TaskMS\Models\ActivityAssignment;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Dpb\Package\TaskMS\Services\TaskItemRepository;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTaskItem extends EditRecord
{
    protected static string $resource = TaskItemResource::class;
    
    public function getTitle(): string | Htmlable
    {
        $subjectCode = null;
        // $subjectCode = Dpb\Package\TaskMS(TaskAssignment::class)->whereBelongsTo($this->record->task, 'task')->first()->subject?->code?->code;
        // return __('tms-ui::tasks/task-item.update_heading', ['title' => $this->record->taskItem->task->get, 'subject' => '']);
        return '';
    }  

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $subjectId = TaskAssignment::whereBelongsTo($this->record->task)->first()?->subject?->id;
        // $data['subject_id'] = $subjectId;

        $activities = ActivityAssignment::whereMorphedTo('subject', $this->record->taskItem)
            ->with(['activity', 'activity.template'])
            ->get()
            ->map(fn($assignment) => $assignment->activity);
        $data['activities'] = $activities;

        // assigned to
        // $assignedToId = TaskItemAssignment::whereBelongsTo($this->record, 'taskItem')->first()?->assignedTo?->id;
        // $data['assigned_to'] = $assignedToId;

        // dd($data);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $taskItemRepo = Dpb\Package\TaskMS(TaskItemRepository::class);
        $result = $taskItemRepo->update($record, $data);

        return $result;
    }
}
