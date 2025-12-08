<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\MaintenanceGroupResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\MaintenanceGroupResource;
use Dpb\Package\Fleet\Models\Vehicle;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditMaintenanceGroup extends EditRecord
{
    protected static string $resource = MaintenanceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/maintenance-group.update_heading', ['title' => $this->record->code]);
    }  
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // vehicles
        $data['vehicles'] = $this->record->vehicles->pluck('id');
        // dd($this->record->vehicles);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        Vehicle::whereIn('id', $data['vehicles'])->update(['maintenance_group_id' => $record->id]);

        $record->update($data);
        return $record;
    }     
}
