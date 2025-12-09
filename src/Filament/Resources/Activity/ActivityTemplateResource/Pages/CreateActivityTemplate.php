<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\ActivityTemplateResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Activity\ActivityTemplateResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateActivityTemplate extends CreateRecord
{
    protected static string $resource = ActivityTemplateResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template.create_heading');
    }     

  
}
