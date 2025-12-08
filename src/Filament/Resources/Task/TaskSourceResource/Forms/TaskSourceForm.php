<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class TaskForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::tasks/task-source.form.fields.code.label'))
                ->hint(__('tms-ui::tasks/task-source.form.fields.code.hint')),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tasks/task-source.form.fields.title')),
        ];
    }
}
