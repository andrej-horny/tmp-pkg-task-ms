<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Models\TaskHeader;
use Dpb\Package\TaskMS\Models\TickeTaskubject;
use Dpb\Package\TaskMS\Services\Activity\Activity\WorkService;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Dpb\Package\TaskMS\Services\Task\HeaderService;
use Dpb\Package\TaskMS\Services\Task\MaterialService;
use Dpb\Package\TaskMS\Services\Task\ServiceService;
use Dpb\Package\TaskMS\Services\Task\SubjecTaskervice;
use Dpb\Package\Tasks\Models\Task;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class ViewTaskAssignmentPage extends Page
{
    protected static string $resource = TaskAssignmentResource::class;

    protected static string $view = 'filament.resources.Task.task-resource.pages.view-task-page';

    public Task $task;
    public ?TaskHeader $taskHeader;
    public ?Model $tasksubject;
    public $activities;
    public $totalExpectedDuration;
    public $totalDuration;
    public $totalMaterialExpenses;
    public $totalServiceExpenses;
    public $materials;
    public $services;
    public $workIntervals;
    public $workAssignmenTask;

    public function mount(int $record): void
    {
        $this->task = Task::findOrFail($record);
        $this->taskHeader = Dpb\Package\TaskMS(HeaderService::class)->getHeader($this->task);
        $this->tasksubject = Dpb\Package\TaskMS(SubjecTaskervice::class)->geTaskubject($this->task);

        $activitySvc = Dpb\Package\TaskMS(ActivityService::class);
        $this->activities = $activitySvc->getActivities($this->task);
        $this->totalExpectedDuration = $activitySvc->getTotalExpectedDuration($this->task);

        // expense materials
        $materialsSvc = Dpb\Package\TaskMS(MaterialService::class);
        $this->materials = $materialsSvc->getMaterials($this->task);
        $this->totalMaterialExpenses = $materialsSvc->getTotalMaterialExpenses($this->task);

        // expense service
        $servicesSvc = Dpb\Package\TaskMS(ServiceService::class);
        $this->services = $servicesSvc->geTaskervices($this->task);
        $this->totalServiceExpenses = $servicesSvc->getTotalServiceExpenses($this->task);

        // work intervals
        $this->workIntervals = [];
        $wiSvc = Dpb\Package\TaskMS(WorkService::class);
        $this->totalDuration = 0;
        foreach ($this->activities as $activity) {
            $this->workIntervals[$activity->id] = $wiSvc->getWorkIntervals($activity);            
            $this->totalDuration += $wiSvc->getTotalDuration($activity);
        }

        // work assignemnTask
        $this->workAssignmenTask = [];
        foreach ($this->activities as $activity) {
            $this->workAssignmenTask[$activity->id] = $wiSvc->getWorkAssignmenTask($activity);            
        }        
    }    
}
