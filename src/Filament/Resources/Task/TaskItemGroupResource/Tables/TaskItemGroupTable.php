<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class TaskItemGroupTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task-item-group.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task-item-group.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // code
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tasks/task-item-group.table.columns.code.label'))
                    ->tooltip(__('tms-ui::tasks/task-item-group.table.columns.code.tooltip')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/task-item-group.table.columns.title')),
                // parent
                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('tms-ui::tasks/task-item-group.table.columns.parent')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ImportAction::make()
                //     ->importer(TaskItemGroupImporter::class)
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
