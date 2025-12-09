<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateTemplateGroup extends CreateRecord
{
    protected static string $resource = TemplateGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template-group.create_heading');
    }    
}
