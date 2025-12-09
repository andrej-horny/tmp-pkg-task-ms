<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Tables;

use Dpb\Package\TaskMS\Filament\Imports\Activity\ActivityTemplateImporter;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;

class ActivityTemplateGroupTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::activities/activity-template-group.table.heading'))
            ->emptyStateHeading(__('tms-ui::activities/activity-template-group.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // code
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::activities/activity-template-group.table.columns.code.label'))
                    ->searchable(),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::activities/activity-template-group.table.columns.title.label'))
                    ->searchable(),
                // parent
                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('tms-ui::activities/activity-template-group.table.columns.parent.label')),
                // description
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::activities/activity-template-group.table.columns.description.label')),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ImportAction::make()
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
