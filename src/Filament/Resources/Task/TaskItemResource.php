<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms\TaskItemAssignmentForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables\TaskItemAssignmentTable;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables\TaskItemTable;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TaskItemResource extends Resource
{
    protected static ?string $model = TaskItemAssignment::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task-item.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task-item.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task-item.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task-item.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task-item') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     // return auth()->user()->can('tasks.task-item.read');
    //     return false;
    // }

    public static function form(Form $form): Form
    {
        return TaskItemAssignmentForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskItemAssignmentTable::make($table);
        // return TaskItemTable::make($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskItems::route('/'),
            'create' => Pages\CreateTaskItem::route('/create'),
            'view' => Pages\ViewTaskItemPage::route('/{record}'),
            'edit' => Pages\EditTaskItem::route('/{record}/edit'),
        ];
    }
}
