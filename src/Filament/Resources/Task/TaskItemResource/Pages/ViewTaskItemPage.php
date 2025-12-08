<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource;
use Dpb\Package\TaskMS\Models\ActivityAssignment;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TaskHeader;
use Dpb\Package\TaskMS\Models\TickeTaskubject;
use Dpb\Package\TaskMS\Services\Activity\Activity\WorkService;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Dpb\Package\TaskMS\Services\Task\HeaderService;
use Dpb\Package\TaskMS\Services\Task\MaterialService;
use Dpb\Package\TaskMS\Services\Task\ServiceService;
use Dpb\Package\TaskMS\Services\Task\SubjecTaskervice;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItem;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class ViewTaskItemPage extends Page
{
    protected static string $resource = TaskItemResource::class;

    protected static string $view = 'filament.resources.Task.task-item-resource.pages.view-task-item-page';

    public TaskItem $taskItem;
    public ?TaskAssignment $taskAssignment;
    // public $activities;
    public $totalExpectedDuration;
    public $totalDuration;
    public $totalMaterialExpenses;
    public $totalServiceExpenses;
    public $materials;
    public $services;
    public $workIntervals;
    public $workAssignmenTask;

    // public function __construct(private TaskItem $taskItemRepo) 
    // {
    // }

    public function getHeading(): string
    {
        return 'Podzákzka: ' . $this->taskItem->id . ' - ' . $this->taskItem->title;
    }

    public function mount(
        TaskItem $taskItemRepo,
        TaskAssignment $taskAssignmentRepo,
        ActivityAssignment $activityAssignmentRepo,
        int $record
    ): void {
        // $this->taskItem = TaskItem::findOrFail($record)->first();
        // $this->taskItem = TaskItem::findOrFail($record);
        $this->taskItem = $taskItemRepo->findOrFail($record);

        // $this->taskAssignment = Dpb\Package\TaskMS(HeaderService::class)->getHeader($this->task);
        $this->taskAssignment = $taskAssignmentRepo->whereBelongsTo($this->taskItem->task, 'task')->first();

        // $activitySvc = Dpb\Package\TaskMS(ActivityService::class);
        // $this->activities = $activitySvc->getActivities($this->taskItem);
        // $this->totalExpectedDuration = $activitySvc->getTotalExpectedDuration($this->taskItem);
        // $this->activities = $activityAssignmentRepo->whereMorphedTo('subject', $this->taskItem)
        //     ->with(['activity', 'activity.template'])
        //     ->get()
        //     ->map(fn($assignment) => $assignment->activity);

        // // expense materials
        // $materialsSvc = Dpb\Package\TaskMS(MaterialService::class);
        // $this->materials = $materialsSvc->getMaterials($this->taskItem);
        // $this->totalMaterialExpenses = $materialsSvc->getTotalMaterialExpenses($this->taskItem);

        // // expense service
        // $servicesSvc = Dpb\Package\TaskMS(ServiceService::class);
        // $this->services = $servicesSvc->geTaskervices($this->taskItem);
        // $this->totalServiceExpenses = $servicesSvc->getTotalServiceExpenses($this->taskItem);

    }
}
