<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\ComponenTask;

use Dpb\Package\TaskMS\Services\Task\MaterialService;
use Dpb\Package\Tasks\Models\TaskItem;
use Livewire\Component;

class TaskItemMaterials extends Component
{
    // public TaskItem $taskItem;
    public $materials;
    public $totalMaterialExpenses;

    public function mount(
        TaskItem $taskItem,
        MaterialService $materialSvc
    ) {
        // expense materials
        $this->materials = $materialSvc->getMaterials($taskItem->task);
        $this->totalMaterialExpenses = $materialSvc->getTotalMaterialExpenses($taskItem->task);
    }

    public function render()
    {
        return view('filament.resources.Task.task-item-resource.componenTask.task-item-materials');
    }
}
