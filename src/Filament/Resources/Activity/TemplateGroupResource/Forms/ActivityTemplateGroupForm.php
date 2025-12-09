<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Forms;

use Dpb\Package\Fleet\Models\VehicleModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;

class ActivityTemplateGroupForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label(__('tms-ui::activities/activity-template-group.form.fields.code')),
                Forms\Components\TextInput::make('title')
                    ->label(__('tms-ui::activities/activity-template-group.form.fields.title')),
                Forms\Components\TextInput::make('description')
                    ->label(__('tms-ui::activities/activity-template-group.form.fields.description')),
                Forms\Components\Select::make('parent')
                    ->label(__('tms-ui::activities/activity-template-group.form.fields.parent'))
                    // ->relationship('parent', fn($record) => "{$record?->code} - {$record?->title}")
                    ->relationship('parent', 'title')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
