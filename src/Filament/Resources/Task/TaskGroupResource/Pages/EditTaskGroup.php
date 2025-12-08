<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTaskGroup extends EditRecord
{
    protected static string $resource = TaskGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-group.update_heading', ['title' => $this->record->title]);
    }  
}
