<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-source.create_heading');
    }     
}
