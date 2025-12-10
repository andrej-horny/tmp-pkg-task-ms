<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\RelationManagers\TaskItemRelationManager;
use Dpb\Package\TaskMS\Models\TaskItemAssignment;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\TaskItem;
use Filament\Tables;
use Filament\Tables\Table;

class TaskItemTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task.relation_manager.task_items.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task.relation_manager.task_items.table.empty_state_heading'))
            ->emptyStateDescription(__('tms-ui::tasks/task.relation_manager.task_items.table.empty_state_description'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->state?->getValue()) {
                States\Task\TaskItem\Created::$name => 'bg-blue-200',
                States\Task\TaskItem\Closed::$name => 'bg-green-200',
                States\Task\TaskItem\Cancelled::$name => 'bg-gray-50',
                States\Task\TaskItem\InProgress::$name => 'bg-yellow-200',
                States\Task\TaskItem\AwaitingParts::$name => 'bg-red-200',
                default => null,
            })
            // ->groups([
            //     Tables\Grouping\Group::make('author.name')
            //         ->collapsible(),
            // ])
            // ->defaultGroup('task_id')
            ->defaultGroup(TaskItemRelationManager::class ? null : 'task_id')
            ->columns([
                // task id
                // Tables\Columns\TextColumn::make('task.id')
                //     ->label(__('tms-ui::tasks/task-item.table.columns.task'))
                //     ->tooltip(fn(TaskItem $record) => $record?->task?->title)
                //     ->badge(),
                // task item code id
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tasks/task-item.table.columns.code'))
                    ->grow(false),
                Tables\Columns\TextColumn::make('date')->date()
                    ->label(__('tms-ui::tasks/task-item.table.columns.date'))
                    ->grow(false),
                // Tables\Columns\TextColumn::make('parent.id')
                //     ->label(__('tms-ui::tasks/task-item.table.columns.parent')),
                // title 
                Tables\Columns\TextColumn::make('group.title')
                    ->label(__('tms-ui::tasks/task-item.table.columns.group')),
                // Tables\Columns\TextColumn::make('title')
                //     ->label(__('tms-ui::tasks/task-item.table.columns.title')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::tasks/task-item.table.columns.description'))
                    ->grow(),
                Tables\Columns\SelectColumn::make('state')
                    ->label(__('tms-ui::tasks/task-item.table.columns.state'))
                    // ->state(fn(TaskItem $record) => $record?->state?->label())
                    ->options([
                        States\Task\TaskItem\Created::$name => __('tms-ui::tasks/task.states.created'),
                        States\Task\TaskItem\Closed::$name => __('tms-ui::tasks/task.states.closed'),
                        States\Task\TaskItem\Cancelled::$name => __('tms-ui::tasks/task.states.cancelled'),
                        States\Task\TaskItem\InProgress::$name => __('tms-ui::tasks/task.states.in-progress'),
                    ]),
                // ->state(fn($record) => dd($record)),
                // ->action(
                //     Action::make('select')
                //         ->requiresConfirmation()
                //         ->action(function (TaskItem $record): void {
                //             $record->state == 'created'
                //                 ? $record->state->transition(new CreatedToInProgress($record, auth()->guard()->user()))
                //                 : $record->state->transition(new InProgressToCancelled($record, auth()->guard()->user()));
                //         }),
                // ),
                // TextColumn::make('department.code'),
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::tasks/task-item.table.columns.subject'))
                    // ->state(function (TaskItem $record, TaskAssignmenTaskervice $svc) {
                    //     if ($record->task !== null) {
                    //         return $svc->geTaskubject($record->task)?->code?->code;
                    //     }
                    // })
                    ->hiddenOn(TaskItemRelationManager::class),
                Tables\Columns\TextColumn::make('source.title')
                    ->label(__('tms-ui::tasks/task-item.table.columns.source'))
                    // ->state(function (TaskItem $record, TaskAssignmenTaskervice $svc) {
                    //     if ($record->task !== null) {
                    //         return $svc->geTaskourceLabel($record->task);
                    //     }
                    // })
                    ->hiddenOn(TaskItemRelationManager::class)
                    ->badge(),
                Tables\Columns\TextColumn::make('assigned_to')
                    ->label(__('tms-ui::tasks/task-item.table.columns.assigned_to.label'))
                    ->state(function (TaskItem $record, TaskItemAssignment $taskItemAssignment) {
                        return $taskItemAssignment->whereBelongsTo($record, 'taskItem')->first()?->assignedTo?->code;
                    })
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        '1TPA' => '#888',
                        default => '#333'
                    }),
                    
                // Tables\Columns\TextColumn::make('activities')
                //     ->label(__('tms-ui::tasks/task-item.table.columns.activities'))
                //     ->tooltip(__('tms-ui::tasks/task-item.table.columns.activities.tooltip'))
                //     ->state(function ($record, ActivityService $svc, WorkService $workService) {
                //         // $result = $svc->getActivities($record)?->map(function ($activity) use ($workService) {
                //         //     // dd($workService->getWorkIntervals($activity));
                //         //     return $activity->template->title
                //         //         . ' #' . $activity->template->duration
                //         //         . '/' . $workService->getWorkIntervals($activity)?->sum(function($work) {
                //         //             // return $work;
                //         //             return $work?->duration;
                //         //             // return print_r($work?->duration);
                //         //         });
                //         // });
                //         $activities = $svc->getActivities($record->task);
                //         $totalDuration = 0;
                //         foreach ($activities as $activity) {
                //             $totalDuration += $workService->getTotalDuration($activity);
                //         }
                //         $result = $svc->getTotalExpectedDuration($record->task) . ' min / ' . $totalDuration . ' min';
                //         return $result;
                //     }),
                // Tables\Columns\TextColumn::make('expenses')
                //     ->state(function ($record) {
                //         $result = $record->materials->sum(function ($material) {
                //             return $material->unit_price * $material->quantity;
                //         });
                //         return $result;
                //     }),

                // Tables\Columns\TextColumn::make('expenses')
                //     ->state(function ($record) {
                //         $materials = $record->materials->sum(function ($material) {
                //             return $material->price;
                //         });
                //         $services = $record->services->sum(function ($service) {
                //             return $service->price;
                //         });
                //         return $materials + $services;
                //     }),
                // Tables\Columns\TextColumn::make('man_minutes')
                //     ->state(function ($record) {
                //         $result = $record->activities->sum('duration');
                //         return $result;
                //     }),

            ])
            ->filters([
                //
            ])
            ->actions([
                // ViewAction::make(),
                EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
