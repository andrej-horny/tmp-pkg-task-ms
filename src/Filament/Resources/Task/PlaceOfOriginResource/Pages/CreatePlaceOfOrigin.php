<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePlaceOfOrigin extends CreateRecord
{
    protected static string $resource = PlaceOfOriginResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/place-of-origin.create_heading');
    }      
}
