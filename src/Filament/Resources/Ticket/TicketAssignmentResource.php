<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket;

use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Forms\TicketAssignmentForm;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketAssignmentResource\Tables\TicketAssignmentTable;
use Dpb\Package\TaskMS\Models\TicketAssignment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TicketAssignmentResource extends Resource
{
    protected static ?string $model = TicketAssignment::class;
    // protected static ?string $model = Ticket::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tickets/ticket.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tickets/ticket.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tickets/ticket.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tickets/ticket.navigation.group');
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tickets.ticket.read');
    // }

    public static function form(Form $form): Form
    {
        return TicketAssignmentForm::make($form);
        // return TicketForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TicketAssignmentTable::make($table);
        // return TicketTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketAssignments::route('/'),
            'create' => Pages\CreateTicketAssignment::route('/create'),
            'edit' => Pages\EditTicketAssignment::route('/{record}/edit'),
        ];
    }
}
