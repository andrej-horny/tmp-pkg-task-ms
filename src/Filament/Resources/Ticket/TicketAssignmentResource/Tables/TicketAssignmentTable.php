<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Tables;

use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\States;
use Filament\Tables;
use Filament\Tables\Table;

class TicketAssignmentTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tickets/ticket.table.heading'))
            ->description(__('tms-ui::tickets/ticket.table.description'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->recordClasses(fn($record) => match ($record->ticket->state?->getValue()) {
                States\Ticket\Created::$name => 'bg-blue-200',
                States\Ticket\Closed::$name => 'bg-green-200',
                default => null,
            })
            ->columns([
                // date
                Tables\Columns\TextColumn::make('ticket.date')
                    ->label(__('tms-ui::tickets/ticket.table.columns.date'))
                    ->date('j.n.Y'),
                // type
                Tables\Columns\TextColumn::make('ticket.type.title')
                    ->label(__('tms-ui::tickets/ticket.table.columns.type'))
                    ->badge(),
                // subject
                Tables\Columns\TextColumn::make('subject.code.code')
                    ->label(__('tms-ui::tickets/ticket.table.columns.subject')),
                // ->state(fn(Ticket $record, TicketAssignment $ticketAssignment) => $ticketAssignment->whereBelongsTo($record)->first()?->subject?->code?->code),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('tms-ui::tickets/ticket.table.columns.state'))
                    ->state(fn(TicketAssignment $record) => $record->ticket?->state?->label())
                    ->badge(),
                // description
                Tables\Columns\TextColumn::make('ticket.description')
                    ->label(__('tms-ui::tickets/ticket.table.columns.description'))
                    ->grow()
                    ->searchable(),
            ])
            ->filters(TicketAssignmentTableFilters::make())
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (
                        $record,
                        array $data,
                        TicketAssignment $ticketAssignment,
                    ): array {

                        $data['subject_id'] = $ticketAssignment->whereBelongsTo($record)->first()->subject->id;
                        dd($data);
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
                // CreateTaskAction::make('create_task'),
                // CreateTaskAction::make('create_task'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
