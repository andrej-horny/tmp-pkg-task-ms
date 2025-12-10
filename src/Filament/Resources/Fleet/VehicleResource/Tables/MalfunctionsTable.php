<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource\Tables;

use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Models\TicketAssignment;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class MalfunctionsTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public Vehicle $vehicle;

    public function table(Table $table): Table
    {
        return $table
            // ->heading(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.heading'))
            ->emptyStateHeading(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->query(
            TicketAssignment::query()
                ->whereMorphedTo('subject', $this->vehicle)
                ->byTicketTypeCode('malfunction')
            )
            ->columns([
                // date
                Tables\Columns\TextColumn::make('ticket.date')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.date'))
                    ->date('j.n.Y')
                    ->searchable(),
                // inspection template
                Tables\Columns\TextColumn::make('ticket.template.title')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.template'))
                    ->searchable(),
                // place of origin
                Tables\Columns\TextColumn::make('place_of_origin')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.place_of_origin'))
                    ->searchable(),
                // state
                Tables\Columns\TextColumn::make('ticket.state')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.state'))
                    ->state(fn ($record) => $record->ticket->state->label())
                    ->searchable(),
                // in warranty
                Tables\Columns\IconColumn::make('in_warranty')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.in_warranty'))
                    ->boolean()
                    ->searchable(),
                // time
                Tables\Columns\IconColumn::make('time')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.time.label'))
                    ->tooltip(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.time.tooltip'))
                    ->searchable(),
                // expenses
                Tables\Columns\IconColumn::make('expenses')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.expenses.label'))
                    ->tooltip(__('tms-ui::fleet/vehicle.form.tabs.malfunctions.columns.expenses.tooltip'))
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('assignee_id')
                //     ->relationship('assignee', 'name'),
            ])
            ->recordAction(null)   // ✅ read-only
            ->bulkActions([]);     // ✅ read-only
    }

    public function render()
    {
        return view('tms-ui::livewire.tables.fleet.vehicle.malfunctions');
    }
}
