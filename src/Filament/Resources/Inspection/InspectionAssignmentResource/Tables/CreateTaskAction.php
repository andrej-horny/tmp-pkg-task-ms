<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Tables;

use Dpb\Package\TaskMS\Commands\Task\CreateTaskCommand;
use Dpb\Package\TaskMS\Commands\TaskAssignment\CreateTaskAssignmentCommand;
use Dpb\Package\TaskMS\Handlers\Task\CreateTaskHandler;
use Dpb\Package\TaskMS\Handlers\TaskAssignment\CreateTaskAssignmentHandler;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\UseCases\TicketAssignment\CreateFromInspectionUseCase;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\DB;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Dpb\Package\Tasks\Models\TaskGroup;

class CreateTaskAction
{
    public static function make($uri): Action
    {
        return Action::make($uri)
            ->label(__('tms-ui::inspections/inspection.table.actions.create_task'))
            ->button()
            // ->action(function (InspectionAssignment $record, TicketAssignmentRepository $ticketAssignmentRepository) {
            //     $ticketAssignmentRepository->createFromInspectionAssignment($record);
            // })
            ->action(function (InspectionAssignment $record, CreateTaskAssignmentHandler $taCHdl, CreateTaskHandler $taskCHdl) {
                return DB::transaction(function () use ($record, $taCHdl, $taskCHdl) {
                    // create task
                    $taskGroupId = TaskGroup::byCode('inspection')->first()->id;
                    $placeOfOriginId = PlaceOfOrigin::byUri('during-maintenance')->first()?->id;
                    $task = $taskCHdl->handle(
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
                    return $taCHdl->handle(
                        new CreateTaskAssignmentCommand(
                            $task->id,
                            $record->subject_id,
                            'vehicle',
                            $record->inspection->id,
                            $record->inspection->getMorphClass(),
                            auth()->user()->id,
                            $record->subject->maintenanceGroup->id,
                            $record->subject->maintenanceGroup->getMorphClass()
                        )
                    );
                });
            })
            ->visible(function (InspectionAssignment $record) {
                // return true;
                // return $ticketAssignment->whereHasMorph($record, $record->getMorphClass());
                return !TaskAssignment::where('source_type', $record->inspection->getMorphClass())
                    ->where('source_id', $record->id)
                    ->exists();
            });
    }
}
