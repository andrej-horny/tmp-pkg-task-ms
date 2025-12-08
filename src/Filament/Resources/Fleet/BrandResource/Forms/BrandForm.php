<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class BrandForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }


    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::fleet/vehicle-brand.form.fields.title'))
                ->required(),
        ];
    }
}
