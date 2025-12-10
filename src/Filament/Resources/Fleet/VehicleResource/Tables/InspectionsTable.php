<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleResource\Tables;

use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Dpb\Package\Fleet\Models\Vehicle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class InspectionsTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public Vehicle $vehicle;

    public function table(Table $table): Table
    {
        return $table
            // ->heading(__('tms-ui::fleet/vehicle.form.tabs.inspections.heading'))
            ->emptyStateHeading(__('tms-ui::fleet/vehicle.form.tabs.inspections.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->query(
            InspectionAssignment::query()->whereMorphedTo('subject', $this->vehicle)
            )
            ->columns([
                // date
                Tables\Columns\TextColumn::make('inspection.date')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.date'))
                    ->date('j.n.Y')
                    ->searchable(),
                // inspection template
                Tables\Columns\TextColumn::make('inspection.template.title')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.template'))
                    ->searchable(),
                // distance
                Tables\Columns\TextColumn::make('distance')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.distance'))
                    ->searchable(),
                // state
                Tables\Columns\TextColumn::make('inspection.state')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.state'))
                    ->searchable(),
                // assigned to
                Tables\Columns\TextColumn::make('assignedTo.title')
                    ->label(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.maintenance_group.label'))
                    ->tooltip(__('tms-ui::fleet/vehicle.form.tabs.inspections.columns.maintenance_group.tooltip'))
                    ->searchable(),
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
        return view('tms-ui::livewire.tables.fleet.vehicle.inspections');
    }
}
