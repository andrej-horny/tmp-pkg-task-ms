<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\ActivityTemplateResource\Forms;

use Dpb\Package\Fleet\Models\VehicleModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;

class ActivityTemplateForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema([
                // code
                Forms\Components\TextInput::make('code')
                    ->label(__('tms-ui::activities/activity-template.form.fields.code.label')),
                // title 
                Forms\Components\TextInput::make('title')
                    ->label(__('tms-ui::activities/activity-template.form.fields.title')),
                // duration
                Forms\Components\TextInput::make('duration')
                    ->label(__('tms-ui::activities/activity-template.form.fields.duration.label'))
                    ->numeric(),
                // is divisible
                Forms\Components\Checkbox::make('is_divisible')
                    ->label(__('tms-ui::activities/activity-template.form.fields.is_divisible'))
                    ->live(),
                // is catalogised
                Forms\Components\Checkbox::make('is_catalogised')
                    ->label(__('tms-ui::activities/activity-template.form.fields.is_catalogised')),
                // people
                Forms\Components\TextInput::make('people')
                    ->label(__('tms-ui::activities/activity-template.form.fields.people'))
                    ->numeric()
                    ->visible(fn(Get $get) => $get('is_divisible')),

                // tempalteable
                Forms\Components\Select::make('templatable_id')
                    ->label(__('tms-ui::activities/activity-template.form.fields.templatable.label'))
                    ->hint(__('tms-ui::activities/activity-template.form.fields.templatable.hint'))
                    ->options(fn() => VehicleModel::pluck('title', 'id'))
                    ->preload()
                    ->searchable(),
                // // subjects
                // Forms\Components\Section::make('tms-ui::activities/activity-template.form.sections.subjects')
                //     ->schema([
                //         Forms\Components\CheckboxList::make('vehicle_models')
                //             ->label(__('tms-ui::activities/activity-template.form.fields.subjects'))
                //             ->bulkToggleable()
                //             ->searchable()
                //             ->columns(4)
                //             ->options(fn() => VehicleModel::pluck('title', 'id'))
                //     ])
            ]);
    }
}
