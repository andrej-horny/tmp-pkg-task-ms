<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Pages;

use DateTimeImmutable;
use Dpb\Package\TaskMS\Commands\Ticket\UpdateTicketCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\TicketCommand;
use Dpb\Package\TaskMS\Commands\TicketAssignment\UpdateTicketAssignmentCommand;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource;
use Dpb\Package\TaskMS\Handlers\Ticket\UpdateTicketHandler;
use Dpb\Package\TaskMS\Handlers\TicketAssignment\UpdateTicketAssignmentHandler;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Dpb\Package\TaskMS\States;
use Illuminate\Support\Facades\DB;

class EditTicketAssignment extends EditRecord
{
    protected static string $resource = TicketAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tickets/ticket.update_heading', ['title' => $this->record->id]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['subject_id'] = $this->record->subject_id;
        $data['date'] = $this->record->ticket->date;
        $data['description'] = $this->record->ticket->description;
        $data['type_id'] = $this->record->ticket->type_id;
        // dd($data);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            // update ticket
            $ticket =  app(UpdateTicketHandler::class)->handle(
                new UpdateTicketCommand(
                    $record->ticket->id,
                    new DateTimeImmutable($data['date']),
                    $data['description'] ?? null,
                    $data['type_id'],
                    States\Ticket\Created::$name,
                )
            );

            // update ticket assignment
            return app(UpdateTicketAssignmentHandler::class)->handle(
                new UpdateTicketAssignmentCommand(
                    $record->id,
                    $ticket->id,
                    $data['subject_id'],
                    'vehicle',
                )
            );
        });
    }
}
