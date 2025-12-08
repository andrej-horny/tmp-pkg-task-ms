<?php

namespace Dpb\Package\TaskMS\Filament\Resources\DispatchReportResource\Tables;

use Dpb\Package\TaskMS\Models\DispatchReport;
use Dpb\Package\TaskMS\Services\Fleet\VehicleService;
use Dpb\Package\TaskMS\Services\Inspection\CreateTicketService;
use Dpb\Package\TaskMS\Services\Inspection\AssignmentService as InspectionAssignmentService;
use Dpb\Package\TaskMS\Services\TS\TicketAssignmentService;
use Dpb\Package\TaskMS\States;
use Dpb\Package\Inspections\Models\Inspection;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class DispatchReportTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            // ->recordClasses(fn($record) => match ($record->state?->getValue()) {
            //     States\Inspection\Upcoming::$name => 'bg-blue-200',
            //     States\Inspection\InProgress::$name => 'bg-yellow-200',
            //     default => null,
            // })
            ->columns([
                Tables\Columns\TextColumn::make('date')->date('j.n.Y')
                    ->label(__('dispatch-report.table.columns.date.label')),
                Tables\Columns\TextColumn::make('vehicle.code.code')
                    ->label(__('dispatch-report.table.columns.subject.label')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('dispatch-report.table.columns.description.label'))
                    ->formatStateUsing(fn($record) => Str::substr($record->description, 0, 30) . '...'),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('dispatch-report.table.columns.state.label')),
                Tables\Columns\TextColumn::make('author')
                    ->label(__('dispatch-report.table.columns.author.label')),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_ticket')
                    ->label(__('dispatch-report.table.actions.create_ticket'))
                    ->button()
                    ->action(function (DispatchReport $record, TicketAssignmentService $ticketAssignmentService) {
                        $ticketAssignmentService->createFromDispatchReport($record);
                    })
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     // Tables\Actions\DeleteBulkAction::make(),
                //     Tables\Actions\Action::make('bulk_create_tickets')
                //         ->label(__('inspections/upcoming-inspection.table.actions.bulk_create_tickets'))
                //         ->action(function (Collection $records, CreateTicketService $createTicketService) {
                //             foreach ($records as $record) {
                //                 $createTicketService->createTicket($record);
                //             }
                //         })
                // ]),
            ]);
    }
}
