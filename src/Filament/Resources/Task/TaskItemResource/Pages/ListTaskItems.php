<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTaskItems extends ListRecords
{
    protected static string $resource = TaskItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }     
}
