<?php

namespace Dpb\Package\TaskMS\Filament\Resources\DailyExpeditionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\DailyExpeditionResource;
use Dpb\Package\TaskMS\Services\DailyExpeditionRepository;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDailyExpedition extends CreateRecord
{
    protected static string $resource = DailyExpeditionResource::class;

    // protected function handleRecordCreation(array $data): Model
    // {
        // dd($data);

        // return $this->incidentService->createIncident($data);
        // return app(DailyExpeditionRepository::class)->bulkCreate($data);
    // }    
}
