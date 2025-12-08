<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\ComponenTask;

use Dpb\Package\TaskMS\Models\ActivityAssignment;
use Dpb\Package\TaskMS\Services\Activity\Activity\WorkService;
use Dpb\Package\Tasks\Models\TaskItem;
use Livewire\Component;

class TaskItemActivities extends Component
{
    // public TaskItem $taskItem;
    public $activities;
    public $totalExpectedDuration;
    public $totalDuration;
    public $workIntervals;
    public $workAssignmenTask;

    public function mount(
        TaskItem $taskItem,
        ActivityAssignment $activityAssignmentRepo,
    ) {
        $this->activities = $activityAssignmentRepo->whereMorphedTo('subject', $taskItem)
            ->with(['activity', 'activity.template'])
            ->get()
            ->map(fn($assignment) => $assignment->activity);

        // // work intervals
        // $this->workIntervals = [];
        $wiSvc = Dpb\Package\TaskMS(WorkService::class);
        // $this->totalDuration = 0;
        // foreach ($this->activities as $activity) {
        //     $this->workIntervals[$activity->id] = $wiSvc->getWorkIntervals($activity);            
        //     $this->totalDuration += $wiSvc->getTotalDuration($activity);
        // }

        // // work assignemnTask
        $this->workAssignmenTask = [];
        foreach ($this->activities as $activity) {
            $this->workAssignmenTask[$activity->id] = $wiSvc->getWorkAssignmenTask($activity);
        }
    }

    public function render()
    {
        return view('filament.resources.Task.task-item-resource.componenTask.task-item-activities');
    }
}
