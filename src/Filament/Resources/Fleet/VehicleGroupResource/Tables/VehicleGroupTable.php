<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\VehicleGroupResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class VehicleGroupTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::fleet/vehicle-group.table.heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // code
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::fleet/vehicle-group.table.columns.code')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::fleet/vehicle-group.table.columns.title'))
                    ->searchable(),
                // description
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::fleet/vehicle-group.table.columns.description'))
                    ->grow(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ImportAction::make()
                //     ->importer(VehicleGroupImporter::class)
                //     ->csvDelimiter(';')
                // ->visible(auth()->user()->can('fleet.vehicle-group.import'))
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // ->visible(auth()->user()->can('fleet.vehicle-group.update')),
                Tables\Actions\DeleteAction::make()
                // ->visible(auth()->user()->can('fleet.vehicle-group.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make()
                    // ->visible(auth()->user()->can('fleet.vehicle-group.bulk-delete')),
                ]),
            ]);
    }
}
