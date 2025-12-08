<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class TaskItemGroupForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::tasks/task-item-group.form.fields.code.label'))
                ->hint(__('tms-ui::tasks/task-item-group.form.fields.code.hint')),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tasks/task-item-group.form.fields.title')),
        ];
    }
}
