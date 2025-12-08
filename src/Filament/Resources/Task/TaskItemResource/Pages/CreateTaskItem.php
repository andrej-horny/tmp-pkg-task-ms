<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource;
use Dpb\Package\TaskMS\Services\TaskItemRepository;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTaskItem extends CreateRecord
{
    protected static string $resource = TaskItemResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-item.create_heading');
    } 

    protected function handleRecordCreation(array $data): Model
    {
        // dd($data);
        return Dpb\Package\TaskMS(TaskItemRepository::class)->create($data);
    }
}
