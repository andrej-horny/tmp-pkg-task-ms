<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Forms\TaskAssignmentForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\RelationManagers\TaskItemRelationManager;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Tables\TaskAssignmentTable;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TaskAssignmentResource extends Resource
{
    protected static ?string $model = TaskAssignment::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task') ?? 999;
    }

    public static function form(Form $form): Form
    {
        // return TaskForm::make($form);
        return TaskAssignmentForm::make($form);
    }

    public static function table(Table $table): Table
    {
        // return TaskTable::make($table);
        return TaskAssignmentTable::make($table);
    }

    public static function getRelations(): array
    {
        return [
            // ActivitiesRelationManager::class,
            TaskItemRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskAssignments::route('/'),
            'create' => Pages\CreateTaskAssignment::route('/create'),
            // 'view' => Pages\ViewTask::route('/{record}'),
            // 'view' => Pages\ViewTaskPage::route('/{record}'),
            'edit' => Pages\EditTaskAssignment::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
        // return parent::getEloquentQuery()
        //     ->where('subject_type', '=', Dpb\Package\TaskMS(Vehicle::class)->getMorphClass())
        //     ->whereHas('subject', function ($q) {
        //         $userHandledVehicleTypes = auth()->user()->vehicleTypes();
        //         $q->byType($userHandledVehicleTypes);
        //     });
    // }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tasks.task.read');
    // }

    // public static function canCreate(): bool
    // {
    //     return auth()->check() && auth()->user()->can('tasks.task.create');
    // }

    // public static function canEdit(Model $record): bool
    // {
    //     return auth()->check() && auth()->user()->can('tasks.task.update');
    // }

    // public static function canDelete(Model $record): bool
    // {
    //     return auth()->check() && auth()->user()->can('tasks.task.delete');
    // }
}
