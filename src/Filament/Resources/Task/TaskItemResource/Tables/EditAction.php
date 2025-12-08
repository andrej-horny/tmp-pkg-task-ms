<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables;

use Dpb\Package\TaskMS\Models\ActivityAssignment;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Dpb\Package\TaskMS\Models\WorkAssignment;
use Dpb\Package\TaskMS\Services\TaskItemRepository;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Illuminate\Database\Eloquent\Model;

class EditAction
{
    public static function make(): ActionsEditAction
    {
        return ActionsEditAction::make()
            ->modalWidth(MaxWidth::class)
            ->modalHeading(__('tms-ui::tasks/task-item.update_heading', ['code' => '', 'subject' => '']))
            ->mutateRecordDataUsing(function (
                $record,
                array $data,
                TaskAssignment $taskAssignment,
                TaskItemAssignment $taskItemAssignment,
                ActivityAssignment $activityAssignment,
                WorkAssignment $workAssignment
            ): array {
                // subject
                $subjectId = $taskAssignment->whereBelongsTo($record->task)->first()?->subject?->id;
                $data['subject_id'] = $subjectId;

                // activities
                $activities = $activityAssignment->whereMorphedTo('subject', $record)
                    ->with(['activity', 'activity.template'])
                    ->get()
                    ->map(fn($assignment) => $assignment->activity);
                $data['activities'] = $activities;
                // dd($activities);

                // work 
                foreach ($data['activities'] as $key => $activity) {
                    $workAssignmenTask = $workAssignment->whereMorphedTo('subject', $activity)
                        ->with(['workInterval', 'employeeContract'])
                        ->get()
                        ->toArray();
                    // ->map(fn($assignment) => $assignment->workInterval);                            
                    $data['activities'][$key]['workAssignmenTask'] = $workAssignmenTask;
                    // dd($workAssignmenTask);
                }

                // assigned to
                $assignedToId = $taskItemAssignment->whereBelongsTo($record, 'taskItem')->first()?->assignedTo?->id;
                $data['assigned_to'] = $assignedToId;
                // dd($data);
                return $data;
            })
            ->using(function (Model $record, array $data, TaskItemRepository $taskItemRepo): ?Model {
                // dd($data);
                return $taskItemRepo->update($record, $data);
            });
    }
}
