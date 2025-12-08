<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTaskItemGroups extends ListRecords
{
    protected static string $resource = TaskItemGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }      
}
