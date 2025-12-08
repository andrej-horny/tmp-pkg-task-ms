<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionTemplateGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionTemplateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateInspectionTemplateGroup extends CreateRecord
{
    protected static string $resource = InspectionTemplateGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('inspections/inspection-template-group.create_heading');
    }    
}
