<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTaskGroup extends CreateRecord
{
    protected static string $resource = TaskGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-group.create_heading');
    }      
}
