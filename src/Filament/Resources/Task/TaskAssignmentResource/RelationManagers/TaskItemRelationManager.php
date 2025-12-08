<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\RelationManagers;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms\TaskItemForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables\TaskItemTable;
use Dpb\Package\TaskMS\UseCases\TaskAssignment\AddTaskItemUseCase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskItemRelationManager extends RelationManager
{
    protected static string $relationship = 'taskItems';

    public function form(Form $form): Form
    {
        return TaskItemForm::make($form);
    }

    public function table(Table $table): Table
    {
        return TaskItemTable::make($table)
            ->headerActions([
                CreateAction::make()
                    ->modalHeading(__('tms-ui::tasks/task-item.create_heading'))
                    ->using(function (array $data, AddTaskItemUseCase $uc): ?Model {
                        return $uc->execute($this->getOwnerRecord()->id, $data);
                    })
                    ->modalWidth(MaxWidth::class),
            ]);
    }
}
