<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTaskItemGroup extends CreateRecord
{
    protected static string $resource = TaskItemGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-item-group.create_heading');
    }      
}
