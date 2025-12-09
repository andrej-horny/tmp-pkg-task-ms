<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionTemplateResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class InspectionTemplateTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::inspections/inspection-template.table.heading'))
            ->emptyStateHeading(__('tms-ui::inspections/inspection-template.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // // code
                // Tables\Columns\TextColumn::make('code')
                //     ->label(__('tms-ui::inspections/inspection-template.table.columns.code.label')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.title.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('treshold_distance')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.treshold_distance.label'))
                    ->tooltip(__('tms-ui::inspections/inspection-template.table.columns.treshold_distance.tooltip')),
                    // ->state(function ($record) {
                    //     return $record->getCondition('treshold', 'distance_traveled')?->value;
                    // }),
                Tables\Columns\TextColumn::make('first_advance_distance')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.first_advance_distance.label'))
                    ->tooltip(__('tms-ui::inspections/inspection-template.table.columns.first_advance_distance.tooltip')),
                    // ->state(function ($record) {
                    //     return $record->getCondition('1-advance', 'distance_traveled')?->value;
                    // }),
                Tables\Columns\TextColumn::make('second_advance_distance')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.second_advance_distance.label'))
                    ->tooltip(__('tms-ui::inspections/inspection-template.table.columns.second_advance_distance.tooltip')),
                    // ->state(function ($record) {
                    //     return $record->getCondition('2-advance', 'distance_traveled')?->value;
                    // }),
                Tables\Columns\TextColumn::make('treshold_time')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.treshold_time.label')),
                Tables\Columns\TextColumn::make('first_advance_time')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.first_advance_time.label')),
                Tables\Columns\TextColumn::make('second_advance_time')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.second_advance_time.label')),

                Tables\Columns\IconColumn::make('is_periodic')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.is_periodic.label'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('groups.title')
                    ->label(__('tms-ui::inspections/inspection-template.table.columns.groups.label')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
            ]);
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
    }
}
