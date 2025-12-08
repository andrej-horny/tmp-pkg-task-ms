<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-source.update_heading', ['title' => $this->record->title]);
    }     
}
