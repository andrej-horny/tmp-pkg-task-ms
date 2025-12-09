<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\DailyMaintenanceResource\Tables;

use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Inspection\CreateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\CreateInspectionAssignmentHandler;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\States;
use Dpb\Package\TaskMS\UseCases\DailyMaintenance\CreateDailyMaintenanceUseCase;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tasks\Models\TaskGroup;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class DailyMaintenanceTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::inspections/daily-maintenance.table.heading'))
            ->emptyStateHeading(__('tms-ui::inspections/daily-maintenance.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->inspection?->state?->getValue()) {
                States\Inspection\Upcoming::$name => 'bg-blue-200',
                States\Inspection\InProgress::$name => 'bg-yellow-200',
                default => null,
            })
            ->defaultSort('inspection.date', 'desc')
            ->columns([
                // date
                Tables\Columns\TextColumn::make('inspection.date')->date('j.n.Y')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.date'))
                    ->sortable(),
                // subject
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.subject')),
                // ->state(function ($record, InspectionAssignmentService $svc) {
                //     return $svc->getSubject($record)?->code?->code;
                // }),
                // template
                Tables\Columns\TextColumn::make('inspection.template.title')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.template')),
                // state
                Tables\Columns\TextColumn::make('inspection.state')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.state'))
                    ->state(fn(InspectionAssignment $record) => $record->inspection?->state?->label()),
                // maintenance group
                Tables\Columns\TextColumn::make('subject.maintenanceGroup.code')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.maintenance_group'))
                    ->badge(),
                // TO DO
                // note
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.note')),
                // total time
                Tables\Columns\TextColumn::make('total_time')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.total_time')),
                // contracts
                Tables\Columns\TextColumn::make('contracts')
                    ->label(__('tms-ui::inspections/daily-maintenance.table.columns.contracts')),
            ])
            ->filters(DailyMaintenanceTableFilters::make())
            ->headerActions([
                // CreateDailyMaintenanceAction::make('create_daily_maintenance')
                Tables\Actions\CreateAction::make()
                    ->model(InspectionAssignment::class)
                    ->action(function (array $data) {
                        DB::transaction(function () use ($data) {
                            foreach ($data['vehicles'] as $vehicleId) {
                                // create inspection
                                $inspection = app(CreateInspectionHandler::class)->handle(
                                    new CreateInspectionCommand(
                                        new \DateTimeImmutable($data['date']),
                                        $data['inspection-template'] ?? null,
                                        States\Inspection\Upcoming::$name,
                                    )
                                );

                                // create inspection assignment
                                $inspectionAssignment = app(CreateInspectionAssignmentHandler::class)->handle(
                                    new CreateInspectionAssignmentCommand(
                                        $inspection->id,
                                        $vehicleId,
                                        'vehicle',
                                    )
                                );

                                // create task
                                $taskGroupId = TaskGroup::byCode('daily-maintenance')->first()->id;
                                $placeOfOriginId = PlaceOfOrigin::byUri('during-maintenance')->first()?->id;
                                $task = app(CreateTaskHandler::class)->handle(
                                    new CreateTaskCommand(
                                        new \DateTimeImmutable(),
                                        null,
                                        null,
                                        $taskGroupId,
                                        States\Task\Task\Created::$name,
                                        $placeOfOriginId
                                    )
                                );

                                // create task assignment
                                // dd($placeOfOriginId);
                                $taskAssignment = app(CreateTaskAssignmentHandler::class)->handle(
                                    new CreateTaskAssignmentCommand(
                                        $task->id,
                                        $vehicleId,
                                        'vehicle',
                                        $inspection->id,
                                        $inspection->getMorphClass(),
                                        auth()->user()->id,
                                        null, //$record->subject->maintenanceGroup->id,
                                        null //record->subject->maintenanceGroup->getMorphClass()
                                    )
                                );
                            }
                        });
                    })
                    ->modalWidth(MaxWidth::class)
                    ->modalDescription('TO DO: toto by malo do budúcna prepojené s fondom pracovného času')
                    ->modalHeading(__('tms-ui::inspections/daily-maintenance.create_heading')),
            ]);
    }
}
