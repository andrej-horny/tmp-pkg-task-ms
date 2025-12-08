<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTaskItemGroup extends EditRecord
{
    protected static string $resource = TaskItemGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-item-group.update_heading', ['title' => $this->record->title]);
    }  
}
