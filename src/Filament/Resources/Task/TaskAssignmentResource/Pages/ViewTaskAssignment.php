<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewTaskAssignment extends ViewRecord
{
    protected static string $resource = TaskAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        // return __('tms-ui::tasks/task.update_heading', ['title' => $this->record->id]);
        return '';
    }  
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $data['subject_id'] = Dpb\Package\TaskMS(TaskAssignment::class)->whereBelongsTo($this->record)->first()?->subject?->id;

        // task group
        $data['task']['date'] = $this->record->task->date;
        $data['task']['group_id'] = $this->record->task->group_id;

        // activities
        // $activities = app(ActivityService::class)->getActivities($this->record->task)->toArray();
        // $data['activities'] = $activities;
        // dd($activities);
        return $data;
    }
}
