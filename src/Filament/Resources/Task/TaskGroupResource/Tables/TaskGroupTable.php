<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskGroupResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class TaskGroupTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task-group.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task-group.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tasks/task-group.table.columns.code.label'))
                    ->tooltip(__('tms-ui::tasks/task-group.table.columns.code.tooltip')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/task-group.table.columns.title')),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('tms-ui::tasks/task-group.table.columns.parent')),
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
