<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class TaskTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tasks/task-source.table.columns.code.label'))
                    ->tooltip(__('tms-ui::tasks/task-source.table.columns.code.tooltip')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/task-source.table.columns.title.label')),
            ])
            ->filters([
                //
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
