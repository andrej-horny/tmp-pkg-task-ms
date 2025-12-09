<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTemplateGroups extends ListRecords
{
    protected static string $resource = TemplateGroupResource::class;

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
