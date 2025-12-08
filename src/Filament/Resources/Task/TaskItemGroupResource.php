<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Forms\TaskItemGroupForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Tables\TaskItemGroupTable;
use Dpb\Package\Tasks\Models\TaskItemGroup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TaskItemGroupResource extends Resource
{
    protected static ?string $model = TaskItemGroup::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task-item-group.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task-item-group.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task-item-group.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task-item-group.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task-item-group') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     // return auth()->user()->can('tasks.task-item.read');
    //     return false;
    // }

    public static function form(Form $form): Form
    {
        return TaskItemGroupForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskItemGroupTable::make($table);
        // return TaskItemGroupTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskItemGroups::route('/'),
            'create' => Pages\CreateTaskItemGroup::route('/create'),
            // 'view' => Pages\ViewTaskItemGroupPage::route('/{record}'),
            'edit' => Pages\EditTaskItemGroup::route('/{record}/edit'),
        ];
    }
}
