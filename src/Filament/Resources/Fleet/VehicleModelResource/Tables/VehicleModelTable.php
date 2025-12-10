<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleModelResource\Tables;

use Dpb\Package\TaskMS\Filament\Imports\Fleet\VehicleModelImporter;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Filament\Forms;
use Illuminate\Database\Eloquent\Collection;

class VehicleModelTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::fleet/vehicle-model.table.heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // vehicle-brand
                Tables\Columns\TextColumn::make('brand.title')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.brand.label'))
                    ->searchable(),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.title.label'))
                    ->searchable(),
                // year
                Tables\Columns\TextColumn::make('year')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.year.label')),
                // length
                Tables\Columns\TextColumn::make('length')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.length.label'))
                    ->state(function ($record) {
                        // dd($record->attributeValues());
                        return $record->getAttrValue('length');
                    })
                    ->numeric(decimalPlaces: 2),
// seats
                Tables\Columns\TextColumn::make('seats')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.seats.label'))
                    ->tooltip(__('tms-ui::fleet/vehicle-model.table.columns.seats.tooltip')),
                // TextColumn::make('fuel_consumption'),
                // TextColumn::make('length')
                //     ->state(function ($record) {
                //         return $record->getAttrValue('length');
                //     }),
                // TextColumn::make('warranty'),
                // type
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('tms-ui::fleet/vehicle-model.table.columns.type.label')),
                // TextColumn::make('fuelType.title'),
                // TextColumn::make('seats')
                //     ->state(function ($record) {
                //         return $record->getAttrValue('seat-capacity');
                //     }),
                // ->state(function($record) {return print_r($record->attributeValues());}),
            ])
            ->filters(VehicleModelTableFilters::make())
            // ], layout: FiltersLayout::AboveContentCollapsible)
            ->headerActions([
            //     ImportAction::make()
            //         ->importer(VehicleModelImporter::class)
            //         ->csvDelimiter(';')
            //         ->visible(auth()->user()->can('fleet.vehicle-model.import'))
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(auth()->user()->can('fleet.vehicle-model.update')),
                Tables\Actions\DeleteAction::make()
                    ->visible(auth()->user()->can('fleet.vehicle-model.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make()
                    //     ->visible(auth()->user()->can('fleet.vehicle-model.bulk-delete')),
                    BulkSetBrandAction::make('set_vehicle_brand'),
                    BulkSetVehicleTypeAction::make('set_vehicle_type'),
                ]),
            ]);
    }
}
