<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class TicketTypeTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tickets/ticket-type.table.heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                // code
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tickets/ticket-type.table.columns.code')),
                // title
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tickets/ticket-type.table.columns.title')),
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
