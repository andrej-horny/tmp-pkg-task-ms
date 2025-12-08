<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditVehicleGroup extends EditRecord
{
    protected static string $resource = VehicleGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // vehicles
        $data['vehicles'] = $this->record->vehicles->pluck('id');
        // dd($this->record->vehicles);

        return $data;
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/vehicle-group.update_heading', ['title' => $this->record->title]);
    }      
}
