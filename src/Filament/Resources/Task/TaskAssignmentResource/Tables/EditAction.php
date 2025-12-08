<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Tables;

use Dpb\Package\TaskMS\Services\Task\CreateTickeTaskervice;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Dpb\Package\TaskMS\Services\Task\HeaderService;
use Dpb\Package\TaskMS\Services\Task\SubjecTaskervice;
use Filament\Tables\Actions\EditAction as BaseEditAction;
use Illuminate\Database\Eloquent\Model;

class EditAction
{
    public static function make(): BaseEditAction
    {
        return BaseEditAction::make()
            ->mutateRecordDataUsing(function (
                $record,
                array $data,
                SubjecTaskervice $subjecTaskvc,
                HeaderService $headerSvc,
                ActivityService $activitySvc
            ): array {
                $data['subject_id'] = $subjecTaskvc->geTaskubject($record)?->id;
                $data['department_id'] = $headerSvc->getHeader($record)?->department?->id;
                $data['source_id'] = $record?->source?->id;
                // $activities = $activitySvc->getActivities($record);
                // foreach ($activities as $activity) {
                //     $data['activities'][] = [
                //             'id' => $activity->id,
                //             'date' => $activity->date,
                //             // 'activity_template_id' => $activity->template_id
                //     ];
                // }
                // $data['activities'] = $activitySvc->getActivities($record)
                //     ->map(function($activity) {
                //         return [
                //             'date' => $activity->date,
                //             'activity_template_id' => $activity->template_id
                //         ];
                //     });
                $data['activities'] = $activitySvc->getActivities($record);
                return $data;
            })
            ->using(function (Model $record, array $data, CreateTickeTaskervice $tasksvc): ?Model {
                return $tasksvc->update($record, $data);
            });
    }
}
