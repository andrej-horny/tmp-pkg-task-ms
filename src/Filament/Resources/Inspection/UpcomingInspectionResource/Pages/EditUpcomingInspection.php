<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\UpcomingInspectionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Inspection\UpcomingInspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpcomingInspection extends EditRecord
{
    protected static string $resource = UpcomingInspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
