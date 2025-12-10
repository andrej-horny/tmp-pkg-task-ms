<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\MaintenanceGroupResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class MaintenanceGroupTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::fleet/maintenance-group.table.heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // code
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::fleet/maintenance-group.table.columns.code')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::fleet/maintenance-group.table.columns.title')),
                // vehicle type
                Tables\Columns\TextColumn::make('vehicleType.title')
                    ->label(__('tms-ui::fleet/maintenance-group.table.columns.vehicle_type')),
                // description
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::fleet/maintenance-group.table.columns.description'))
                    ->grow(),
                // Tables\Columns\ColorColumn::make('color')
                //     ->label(__('tms-ui::fleet/maintenance-group.table.columns.color')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
