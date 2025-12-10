<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDailyExpedition extends EditRecord
{
    protected static string $resource = DailyExpeditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/daily-expedition.update_heading', ['title' => $this->record->id]);
    }  
}
