<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms\BrandPicker;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleTypeResource\Forms\VehicleTypePicker;
use Filament\Forms;
use Filament\Forms\Form;

class VehicleModelForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema([
                // brand
                BrandPicker::make('brand_id')
                    ->relationship('brand', 'title'),
                // title
                Forms\Components\TextInput::make('title')
                    ->label(__('tms-ui::fleet/vehicle-model.form.fields.title.label')),
                //year
                Forms\Components\TextInput::make('year')
                    ->label(__('tms-ui::fleet/vehicle-model.form.fields.year.label'))
                    ->numeric(),
                // type
                VehicleTypePicker::make('type_id')
                    ->relationship('type', 'title'),

                Forms\Components\Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        // activity templates
                        Forms\Components\Tabs\Tab::make(__('tms-ui::fleet/vehicle-model.form.tabs.activity-templates'))
                            ->schema(ActivityTemplatesTab::make()),
                        // parameters
                        Forms\Components\Tabs\Tab::make(__('tms-ui::fleet/vehicle-model.form.tabs.parameters'))
                            ->schema(ParametersTab::make()),
                        // vehicles
                        Forms\Components\Tabs\Tab::make(__('tms-ui::fleet/vehicle-model.form.tabs.vehicles'))
                            ->schema(VehiclesTab::make()),
                    ]),
                // Forms\Components\Section::make('Parametre')
                //     ->columns(3)
                //     ->schema([

                //         Forms\Components\Section::make('rozmery')
                //             ->columnSpan(1)
                //             ->schema([]),
                //         Forms\Components\Section::make('hmotnosti')
                //             ->columnSpan(1)
                //             ->schema([]),
                //         Forms\Components\Section::make('pocet_miest')
                //             ->columnSpan(1)
                //             ->schema([]),
                //     ]),
            ]);
    }
}
