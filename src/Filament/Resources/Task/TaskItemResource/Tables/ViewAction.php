<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\RelationManagers\TaskItemRelationManager;
use Dpb\Package\TaskMS\Models\ActivityAssignment;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ViewAction as ActionsViewAction;

class ViewAction
{
    public static function make(): ActionsViewAction
    {
        return ActionsViewAction::make()
            ->modalWidth(MaxWidth::class)
            ->mutateRecordDataUsing(function (
                $record,
                array $data,
                TaskAssignment $taskAssignment,
                TaskItemAssignment $taskItemAssignment,
                ActivityAssignment $activityAssignment
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

                // assigned to
                $assignedToId = $taskItemAssignment->whereBelongsTo($record, 'taskItem')->first()?->assignedTo?->id;
                $data['assigned_to'] = $assignedToId;

                return $data;
            });
    }
}
