<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\DailyMaintenanceResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Inspection\DailyMaintenanceResource;
use Dpb\Package\TaskMS\Services\Inspection\DailyMaintenanceService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;

class ListDailyMaintenances extends ListRecords
{
    protected static string $resource = DailyMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            //     // ->using(function(array $data, DailyMaintenanceService $dmSvc) {
            //     //     $dmSvc->create($data);
            //     //     // logger()->info('form data before save: ', $data);
            //     //     // return $data;
            //     // })
            //     ->using(function(array $data, TicketAssignmentService $taSvc) {
            //         $taSvc->createFromDailyMaintenance($data);
            //     })
            //     ->modalWidth(MaxWidth::class),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }      
}
