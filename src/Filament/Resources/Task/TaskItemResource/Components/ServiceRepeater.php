<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Components;

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Component;
use Filament\Forms;

class ServiceRepeater
{
    public static function make(string $uri): Component
    {
        return TableRepeater::make($uri)
            ->defaultItems(0)
            ->cloneable()
            ->columnSpan(5)
            ->headers([
                Header::make('Dátum'),
                Header::make('Kód'),
                Header::make('Názov'),
                Header::make('Popis'),
                Header::make('Suma'),
                Header::make('Sadzba DPH'),
                // Header::make('attachmenTask'),
            ])
            ->addable(false)            
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->default(now()),
                Forms\Components\TextInput::make('code'),
                Forms\Components\TextInput::make('title'),
                Forms\Components\TextInput::make('description'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->inputMode('decimal'),
                Forms\Components\TextInput::make('vat')
                    ->numeric()
                    ->inputMode('decimal')
            ]);
    }
}
