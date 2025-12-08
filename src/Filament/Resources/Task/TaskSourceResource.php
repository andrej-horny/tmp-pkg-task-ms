<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Forms\TaskForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\RelationManagers;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Tables\TaskTable;
use Dpb\Package\Tasks\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task-source.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task-source.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task-source.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task-source.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task-source') ?? 999;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('tasks.task-source.read');
    }

    public static function form(Form $form): Form
    {
        return TaskForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
