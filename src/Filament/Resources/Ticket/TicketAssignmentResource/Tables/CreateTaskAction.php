<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Tables;

use Dpb\Package\TaskMS\Models\TaskAssignment;
use Dpb\Package\TaskMS\Models\TicketAssignment;
use Dpb\Package\TaskMS\UseCases\TicketAssignment\CreateFromTicketUseCase;
use Filament\Tables\Actions\Action;

class CreateTaskAction
{
    public static function make($uri): Action
    {
        return Action::make($uri)
            ->label(__('tms-ui::tickets/ticket.table.actions.create_ticket'))
            ->button()
            // ->action(function (TicketAssignment $record, TicketAssignmentRepository $ticketAssignmentRepository) {
            //     $ticketAssignmentRepository->createFromTicketAssignment($record);
            // })
            ->action(function (TicketAssignment $record, CreateFromTicketUseCase $createFromTicketUseCase) {
                $createFromTicketUseCase->execute($record);
            })
            ->visible(function (TicketAssignment $record, TicketAssignment $ticketAssignment) {
                // return true;
                // return $ticketAssignment->whereHasMorph($record, $record->getMorphClass());
                return !TaskAssignment::where('source_type', $record->ticket->getMorphClass())
                    ->where('source_id', $record->id)
                    ->exists();
            });
    }
}
