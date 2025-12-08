<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-brand.create_heading');
    }
}
