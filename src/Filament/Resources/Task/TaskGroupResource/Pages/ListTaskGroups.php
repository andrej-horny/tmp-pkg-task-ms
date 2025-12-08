<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTaskGroups extends ListRecords
{
    protected static string $resource = TaskGroupResource::class;

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
