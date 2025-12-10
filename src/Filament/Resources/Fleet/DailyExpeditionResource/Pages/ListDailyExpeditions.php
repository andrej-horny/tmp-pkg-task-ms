<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListDailyExpeditions extends ListRecords
{
    protected static string $resource = DailyExpeditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\Action::make('bulkCreate')
                ->label('Vytvoriť')
                ->color('primary')
                ->icon('heroicon-o-plus')
                ->url(DailyExpeditionResource::getUrl('bulk-create')),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }      
}
