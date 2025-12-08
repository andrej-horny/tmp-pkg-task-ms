<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-source.list_heading');
    }     
}
