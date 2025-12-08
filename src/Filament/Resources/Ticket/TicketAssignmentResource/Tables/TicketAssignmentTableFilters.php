<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Tables;

use Dpb\Package\TaskMS\Filament\Components\VehiclePicker;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Tickets\Models\TicketSource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Dpb\Package\TaskMS\States;

class TicketAssignmentTableFilters
{
    public static function make(): array
    {
        return [
            // date
            Tables\Filters\Filter::make('date')
                ->form([
                    DatePicker::make('date')
                        ->label(__('tms-ui::tickets/ticket.table.filters.date')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date'],
                            fn(Builder $query, $date): Builder =>
                            $query->whereHas('ticket', function ($q) use ($date) {
                                $q->whereDate('date', '=', $date);
                            })
                        );
                }),

            // ticket state
            Tables\Filters\Filter::make('state')
                ->form([
                    ToggleButtons::make('state')
                        ->options([
                            States\Ticket\Created::$name => __('tms-ui::tickets/ticket.states.created'),
                            States\Ticket\Closed::$name => __('tms-ui::tickets/ticket.states.closed'),
                        ])
                        ->multiple()
                        ->inline()
                        ->label(__('tms-ui::tickets/ticket.table.filters.state')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['state'],
                            fn(Builder $query, $state): Builder =>
                            $query->whereHas('ticket', function ($q) use ($state) {
                                $q->whereIn('state', $state);
                            })
                        );
                }),
            // subject
            Tables\Filters\Filter::make('subject')
                ->form([
                    VehiclePicker::make('subject')
                        ->options(
                            Vehicle::query()
                                ->has('codes')
                                ->with(['codes' => fn($q) => $q->orderByDesc('date_from'), 'model'])
                                ->get()
                                ->mapWithKeys(function (Vehicle $vehicle) {
                                    $latestCode = $vehicle->codes->first();
                                    if (!$latestCode) {
                                        return []; // important: return empty array if no code
                                    }
                                    return [
                                        $vehicle->id => $latestCode->code,
                                    ];
                                })
                                ->toArray()
                        )
                        ->getSearchResultsUsing(null)
                        ->getOptionLabelFromRecordUsing(null)
                        ->searchable()
                        ->multiple()
                        ->label(__('tms-ui::tickets/ticket.table.filters.subject')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['subject'],
                            fn(Builder $query, $subject): Builder =>
                            $query->whereMorphedTo(
                                'subject',
                                app(Vehicle::class)->getMorphClass(),
                            )
                                ->whereIn('subject_id', $subject)
                        );
                }),
        ];
    }
}
