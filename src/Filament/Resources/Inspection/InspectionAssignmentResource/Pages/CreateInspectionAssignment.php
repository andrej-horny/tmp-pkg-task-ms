<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Pages;

use Dpb\Package\TaskMS\Handlers\InspectionAssignment\CreateInspectionAssignmentHandler;
use Dpb\Package\TaskMS\Commands\Inspection\CreateInspectionCommand;
use Dpb\Package\TaskMS\Commands\InspectionAssignment\CreateInspectionAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource;
use Dpb\Package\TaskMS\Handlers\Inspection\CreateInspectionHandler;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class CreateInspectionAssignment extends CreateRecord
{
    protected static string $resource = InspectionAssignmentResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::inspections/inspection.create_heading');
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create inspection
            $inspection = app(CreateInspectionHandler::class)->handle(
                new CreateInspectionCommand(
                    new \DateTimeImmutable($data['date']),
                    $data['template_id'] ?? null,
                    States\Inspection\Upcoming::$name,
                )
            );

            // create inspection assignment
            return app(CreateInspectionAssignmentHandler::class)->handle(
                new CreateInspectionAssignmentCommand(
                    $inspection->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
