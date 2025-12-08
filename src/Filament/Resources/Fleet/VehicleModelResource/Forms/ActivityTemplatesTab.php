<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms\BrandPicker;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms\VehicleTypePicker;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Filament\Forms;
use Filament\Forms\Form;

class ActivityTemplatesTab
{
    public static function make(): array
    {
        return [
            Forms\Components\Section::make('TO DO')
                ->description('TO DO: pripravujeme. Normy pre tento model vozidla.')
        ];
    }

    public static function make1(): array
    {
        return [

            Forms\Components\Repeater::make('activity_templates')
                ->hiddenLabel()
                ->simple(
                    Forms\Components\Select::make('template')
                        ->options(fn() => ActivityTemplate::pluck('title', 'id'))
                        ->searchable()
                    // Forms\Components\Select::make('template')
                    // ->options()
                    // ->searchable()                    
                )
                ->addable()
                ->deletable()
                ->itemNumbers()
                ->orderable(false)

            // ->label(__('tms-ui::fleet/vehicle-model.form.fields..label'))
            // ->numeric(),
        ];
    }
}
