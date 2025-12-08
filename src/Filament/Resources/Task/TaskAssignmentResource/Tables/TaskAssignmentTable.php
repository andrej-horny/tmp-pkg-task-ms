<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Tables;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Services\Activity\Activity\WorkService;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Dpb\Package\TaskMS\States;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TaskAssignmentTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->task?->state?->getValue()) {
                States\Task\Task\Created::$name => 'bg-blue-200',
                States\Task\Task\Closed::$name => 'bg-green-200',
                States\Task\Task\Cancelled::$name => 'bg-gray-50',
                States\Task\Task\InProgress::$name => 'bg-yellow-200',
                default => null,
            })
            ->columns([
                Tables\Columns\TextColumn::make('task.id')
                    ->label(__('tms-ui::tasks/task.table.columns.id')),
                // date
                Tables\Columns\TextColumn::make('task.date')
                    ->date('j.n.Y')
                    ->label(__('tms-ui::tasks/task.table.columns.date')),
                // subject
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::tasks/task.table.columns.subject')),
                // ->state(function ($record, TaskAssignment $svc) {
                //     return $svc->whereBelongsTo($record)->first()->subject?->code?->code;
                // }),
                // group type 
                Tables\Columns\TextColumn::make('task.group.title')
                    ->label(__('tms-ui::tasks/task.table.columns.group')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/task.table.columns.title')),
                // Tables\Columns\TextColumn::make('title')
                //     ->label(__('tms-ui::tasks/task.table.columns.title.label')),
                // deacription
                Tables\Columns\TextColumn::make('task.description')
                    ->label(__('tms-ui::tasks/task.table.columns.description'))
                    ->searchable()
                    ->grow(),
                // state
                Tables\Columns\SelectColumn::make('task.state')
                    ->label(__('tms-ui::tasks/task.table.columns.state'))
                    ->options([
                        States\Task\Task\Created::$name => __('tms-ui::tasks/task.states.created'),
                        States\Task\Task\Closed::$name => __('tms-ui::tasks/task.states.closed'),
                        States\Task\Task\Cancelled::$name => __('tms-ui::tasks/task.states.cancelled'),
                        States\Task\Task\InProgress::$name => __('tms-ui::tasks/task.states.in-progress'),
                    ]),
                // Tables\Columns\TextColumn::make('task.state')
                //     ->label(__('tms-ui::tasks/task.table.columns.state'))
                //     ->state(fn(TaskAssignment $record) => $record->task->state->label()),
                // ->state(fn($record) => dd($record)),
                // ->action(
                //     Action::make('select')
                //         ->requiresConfirmation()
                //         ->action(function (TaskAssignment $record): void {
                //             $task = $record->task;
                //             $task->state == 'created'
                //                 ? $task->state->transition(new CreatedToInProgress($task, auth()->guard()->user()))
                //                 : $task->state->transition(new InProgressToCancelled($task, auth()->guard()->user()));
                //         }),
                // ),
                // assigned to / maintenance group
                Tables\Columns\TextColumn::make('assignedTo.code')
                    ->badge()
                    ->label(__('tms-ui::tasks/task.table.columns.assigned_to')),
                    // ->tooltip(__('tms-ui::tasks/task.table.columns.assigned_to')),
                // place of occurance / task source
                Tables\Columns\TextColumn::make('task.source.title')
                    ->label(__('tms-ui::tasks/task.table.columns.source')),
                // Tables\Columns\TextColumn::make('department')
                //     ->label(__('tms-ui::tasks/task.table.columns.department.label'))
                //     ->state(function (HeaderService $svc, $record) {
                //         return $svc->getHeader($record)?->department?->code;
                //     }),
                // Tables\Columns\TextColumn::make('activities')
                //     ->label(__('tms-ui::tasks/task.table.columns.activities.label'))
                //     ->tooltip(__('tms-ui::tasks/task.table.columns.activities.tooltip'))
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
                //     ->label(__('tms-ui::tasks/task.table.columns.total_expenses'))
                // ->state(function ($record) {
                // $total = 0;
                // if ($record->has('materials')) {
                //     $total += $record->materials->sum(function ($material) {
                //         return $material->price;
                //     });
                // }
                // if ($record->has('services')) {
                //     $services = $record->services->sum(function ($service) {
                //         return $service->price;
                //     });
                // }
                // return $total;
                // }),
                // Tables\Columns\TextColumn::make('man_minutes')
                //     ->state(function ($record) {
                //         $result = $record->activities->sum('duration');
                //         return $result;
                //     }),
            ])
            // ->filters(TaskAssignmentTableFilters::make())
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
