<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\ActivityTemplateResource\Tables;

use Dpb\Package\TaskMS\Filament\Imports\Activity\ActivityTemplateImporter;
use Dpb\Package\TaskMS\Models\ActivityTemplatable;
use Dpb\Package\Fleet\Models\VehicleModel;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityTemplateTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::activities/activity-template.table.heading'))
            ->emptyStateHeading(__('tms-ui::activities/activity-template.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::activities/activity-template.table.columns.title.label'))
                    ->searchable(),
                // duration
                Tables\Columns\TextColumn::make('duration')
                    ->label(__('tms-ui::activities/activity-template.table.columns.duration.label')),
                // man minutes
                Tables\Columns\TextColumn::make('man_minutes')
                    ->label(__('tms-ui::activities/activity-template.table.columns.man_minutes.label')),
                // is divisible
                Tables\Columns\IconColumn::make('is_divisible')
                    ->label(__('tms-ui::activities/activity-template.table.columns.is_divisible.label'))
                    ->boolean(),
                // Tables\Columns\IconColumn::make('is_standardised')
                //     ->label(__('tms-ui::activities/activity-template.table.columns..label'))
                //     ->boolean(),
                // is catalogised
                Tables\Columns\IconColumn::make('is_catalogised')
                    ->label(__('tms-ui::activities/activity-template.table.columns.is_catalogised.label'))
                    ->boolean(),
                // people
                Tables\Columns\TextColumn::make('people')
                    ->label(__('tms-ui::activities/activity-template.table.columns.people.label')),
                // Tables\Columns\TextColumn::make('sa1')
                //     ->label('sa1')
                //     ->state(function($record, UnitRateService $svc) {                        

                //         return $svc->getUnitRate($record)?->formatted_rate;
                //     }),
                // templatable
                Tables\Columns\TextColumn::make('templatable')
                    ->label('subj')
                    ->state(fn($record, ActivityTemplatable $templatable) => $templatable
                        ->where('template_id', '=', $record->id)
                        ->with('templatable')
                        ->get()
                        ->pluck('templatable.title'))
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('subject')
                //     ->options(fn(VehicleModel $vehicleModel) => $vehicleModel::pluck('title', 'id')) 
                //     ->
                //     ->searchable()
                //     ->preload()
                //     ->multiple()
            ])
            ->headerActions([
                // Tables\Actions\ImportAction::make()
                //     ->importer(ActivityTemplateImporter::class)
                //     ->csvDelimiter(';')
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // ->visible(auth()->user()->can('fleet.vehicle-model.update')),
                Tables\Actions\DeleteAction::make()
                // ->visible(auth()->user()->can('fleet.vehicle-model.delete')),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make()
                //         ->visible(auth()->user()->can('fleet.vehicle-model.bulk-delete')),
                // ]),
            ]);
    }
}
