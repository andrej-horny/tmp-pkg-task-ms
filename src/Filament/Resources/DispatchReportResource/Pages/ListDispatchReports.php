<?php

namespace Dpb\Package\TaskMS\Filament\Resources\DispatchReportResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\DispatchReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDispatchReports extends ListRecords
{
    protected static string $resource = DispatchReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
