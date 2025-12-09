<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\UpcomingInspectionResource\Tables;

use Dpb\Package\TaskMS\States;
use Filament\Tables;
use Filament\Tables\Table;

class UpcomingInspectionAssignmentTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::inspections/upcoming-inspection.table.heading'))
            ->emptyStateHeading(__('tms-ui::inspections/upcoming-inspection.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            // ->recordClasses(fn($record) => match ($record->state?->getValue()) {
            //     States\Inspection\Upcoming::$name => 'bg-blue-200',
            //     States\Inspection\InProgress::$name => 'bg-yellow-200',
            //     default => null,
            // })
            ->columns([
                // date
                Tables\Columns\TextColumn::make('inspection.date')
                    ->date('j.n.Y')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.date.label')),
                // subject
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.subject.label')),
                    // ->state(function ($record, InspectionAssignmentService $svc) {
                    //     return $svc->getSubject($record->inspection)?->code?->code;
                    // }),
                // inspection template
                Tables\Columns\TextColumn::make('inspection.template.title')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.template.label')),
                // Tables\Columns\TextColumn::make('state')
                //     ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.state.label'))
                // ->state(fn(Inspection $record) => $record?->state?->label()),
                // maintenance group
                Tables\Columns\TextColumn::make('subject.maintenanceGroup.code')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.maintenance_group.label'))
                    ->tooltip(__('tms-ui::inspections/upcoming-inspection.table.columns.maintenance_group.tooltip')),
                // note
                Tables\Columns\TextColumn::make('inspection.note')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.note.label')),
                // distance traveled
                Tables\Columns\TextColumn::make('distance_traveled')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.distance_traveled.label')),
                    // ->state(function ($record, VehicleService $vehicleSvc, InspectionAssignmentService $assignmentSvc) {
                    //     $vehicle = $assignmentSvc->getSubject($record->inspection);
                    //     if ($vehicle !== null) {
                    //         return round($vehicleSvc->getInspectionDistanceTraveled($vehicle), 2);
                    //     }
                    // }),
                Tables\Columns\TextColumn::make('due_distance')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.due_distance.label')),
                Tables\Columns\TextColumn::make('km_to_due_distance')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.km_to_due_distance.label')),
                Tables\Columns\TextColumn::make('due_date')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.due_date.label')),
                Tables\Columns\TextColumn::make('days_to_due_date')
                    ->label(__('tms-ui::inspections/upcoming-inspection.table.columns.days_to_due_date.label')),
                // link to ticket
                // Tables\Columns\TextColumn::make('ticket')
                //     ->label('ticket')
                //     ->formatStateUsing(fn ($state) => $state?->title)
                //     ->url(fn ($record) => $record
                //     ? TicketResource::getUrl('edit', ['record' => 1])
                //     : null
                // ),
            ])
            ->filters(UpcomingInspectionAssignmentTableFilters::make())
            ->actions([
                // CreateTicketAction::make('create_ticket')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\Action::make('bulk_create_tickets')
                    //     ->label(__('tms-ui::inspections/upcoming-inspection.table.actions.bulk_create_tickets'))
                    //     ->action(function (Collection $records, CreateTicketService $createTicketService) {
                    //         foreach ($records as $record) {
                    //             $createTicketService->createTicket($record);
                    //         }
                    //     })
                ]),
            ]);
    }
}
