<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;

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
