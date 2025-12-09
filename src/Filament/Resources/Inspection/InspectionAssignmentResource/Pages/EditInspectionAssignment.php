<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Pages;

use Dpb\Package\TaskMS\Commands\Inspection\UpdateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\UpdateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource;
use Dpb\Package\TaskMS\Handlers\Inspection\UpdateInspectionHandler;
use Dpb\Package\TaskMS\Handlers\InspectionAssignment\UpdateInspectionAssignmentHandler;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class EditInspectionAssignment extends EditRecord
{
    protected static string $resource = InspectionAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection.update_heading', ['title' => $this->record->id]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $subjectId = TicketAssignment::whereBelongsTo($this->record->ticket)->first()?->subject?->id;
        // $data['subject_id'] = $subjectId;

        // $activities = ActivityAssignment::whereMorphedTo('subject', $this->record->ticketItem)
        //     ->with(['activity', 'activity.template'])
        //     ->get()
        //     ->map(fn($assignment) => $assignment->activity);
        // $data['activities'] = $activities;

        // assigned to
        // $assignedToId = TicketItemAssignment::whereBelongsTo($this->record, 'ticketItem')->first()?->assignedTo?->id;
        // $data['assigned_to'] = $assignedToId;

        $data['template_id'] = $this->record->inspection->template_id;
        $data['date'] = $this->record->inspection->date;
        // dd($data);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            // update inspection
            $inspection = app(UpdateInspectionHandler::class)->handle(
                new UpdateInspectionCommand(
                    $record->inspection->id,
                    new \DateTimeImmutable($data['date']),
                    $data['template_id'] ?? null,
                    States\Inspection\Upcoming::$name,
                )
            );

            // update inspection assignment
            return app(UpdateInspectionAssignmentHandler::class)->handle(
                new UpdateInspectionAssignmentCommand(
                    $record->id,
                    $inspection->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
