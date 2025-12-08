<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket;

use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Forms\TicketTypeForm;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Forms\TicketTypeTable;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Tables\TicketTypeTable as TablesTicketTypeTable;
use Dpb\Package\Tickets\Models\TicketType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketTypeResource extends Resource
{
    protected static ?string $model = TicketType::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tickets/ticket-type.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tickets/ticket-type.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tickets/ticket-type.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tickets/ticket-type.navigation.group');
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tickets.ticket-type.read');
    // }    

    public static function form(Form $form): Form
    {
        return TicketTypeForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TablesTicketTypeTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketTypes::route('/'),
            'create' => Pages\CreateTicketType::route('/create'),
            'edit' => Pages\EditTicketType::route('/{record}/edit'),
        ];
    }
}
