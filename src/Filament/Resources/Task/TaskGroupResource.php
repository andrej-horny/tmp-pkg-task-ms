<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Forms\TaskGroupForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Tables\TaskGroupTable;
use Dpb\Package\Tasks\Models\TaskGroup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TaskGroupResource extends Resource
{
    protected static ?string $model = TaskGroup::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task-group.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task-group.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task-group.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task-group.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task-group') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tasks.task-group.read');
    // }

    public static function form(Form $form): Form
    {
        return TaskGroupForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskGroupTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskGroups::route('/'),
            'create' => Pages\CreateTaskGroup::route('/create'),
            'edit' => Pages\EditTaskGroup::route('/{record}/edit'),
        ];
    }
}
