<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Forms;

use Filament\Forms;

class TaskItemGroupPicker
{
    public static function make(string $uri)
    {
        return Forms\Components\Select::make($uri)
            ->label(__('tms-ui::tasks/task-item-group.componenTask.picker.label'))
            ->searchable()
            ->preload()
            ->createOptionForm(TaskItemGroupForm::schema())
            ->createOptionModalHeading(__('tms-ui::tasks/task-item-group.componenTask.picker.create_heading'))
            ->editOptionForm(TaskItemGroupForm::schema())
            ->editOptionModalHeading(__('tms-ui::tasks/task-item-group.picker.update_heading'));
    }
}
