<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class PlaceOfOriginTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/place-of-origin.list_heading'))
            ->emptyStateHeading(__('tms-ui::tasks/place-of-origin.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // uri
                Tables\Columns\TextColumn::make('uri')
                    ->label(__('tms-ui::tasks/place-of-origin.table.columns.uri.label'))
                    ->tooltip(__('tms-ui::tasks/place-of-origin.table.columns.uri.tooltip')),
                // titile 
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/place-of-origin.table.columns.title')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ImportAction::make()
                //     ->importer(TaskGroupImporter::class)
                //     ->csvDelimiter(';')
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
