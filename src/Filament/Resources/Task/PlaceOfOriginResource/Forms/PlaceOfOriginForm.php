<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class PlaceOfOriginForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('uri')
                ->label(__('tms-ui::tasks/place-of-origin.form.fields.uri.label'))
                ->hint(__('tms-ui::tasks/place-of-origin.form.fields.uri.hint')),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tasks/place-of-origin.form.fields.title')),
        ];
    }
}
