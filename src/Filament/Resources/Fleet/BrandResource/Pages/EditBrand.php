<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-brand.update_heading', ['title' => $this->record->title]);
    }      
}
