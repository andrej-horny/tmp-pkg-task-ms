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
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\DB;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tasks\Models\TaskGroup;

class CreateDailyMaintenanceAction
{
    public static function make($uri): Action
    {
        return Action::make($uri)
            ->label(__('tms-ui::inspections/daily_maintenance.table.actions.create_daily_maintenance'))
            ->button()
            // ->action(function (InspectionAssignment $record, TicketAssignmentRepository $ticketAssignmentRepository) {
            //     $ticketAssignmentRepository->createFromInspectionAssignment($record);
            // })
            ->action(function (array $data, CreateTaskAssignmentHandler $taCHdl, CreateTaskHandler $taskCHdl) {                
                if (!isset($data['vehicles'])) {
                    return;
                }
                
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
            });
            // ->visible(function (InspectionAssignment $record) {
            //     // return true;
            //     // return $ticketAssignment->whereHasMorph($record, $record->getMorphClass());
            //     return !TaskAssignment::where('source_type', $record->inspection->getMorphClass())
            //         ->where('source_id', $record->id)
            //         ->exists();
            // });
    }
}
