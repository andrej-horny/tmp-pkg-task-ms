<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Ticket\TicketTypeResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class TicketTypeForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema(static::schema())
            ->columns(6);
    }

    public static function schema(): array
    {
        return [
            // code
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::tickets/ticket-type.form.fields.code.label')),
            // title
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tickets/ticket-type.form.fields.title')),

        ];
    }
}
