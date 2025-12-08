<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPlaceOfOrigin extends EditRecord
{
    protected static string $resource = PlaceOfOriginResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/place-of-origin.update_heading', ['title' => $this->record->title]);
    }      
}
