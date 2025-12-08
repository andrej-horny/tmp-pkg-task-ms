<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\MaintenanceGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\MaintenanceGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateMaintenanceGroup extends CreateRecord
{
    protected static string $resource = MaintenanceGroupResource::class;
    
    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/maintenance-group.create_heading');
    }  
}
