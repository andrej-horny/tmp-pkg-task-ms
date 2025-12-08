<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPlaceOfOrigins extends ListRecords
{
    protected static string $resource = PlaceOfOriginResource::class;

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
