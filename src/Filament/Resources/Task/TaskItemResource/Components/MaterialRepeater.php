<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Components;

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class MaterialRepeater
{
    public static function make(string $uri): Component
    {
        return TableRepeater::make($uri)
            ->defaultItems(0)
            ->cloneable()
            ->columns(12)
            ->headers([
                Header::make('Dátum'),
                Header::make('Kód'),
                Header::make('Názov'),
                Header::make('Popis'),
                Header::make('Suma'),
                Header::make('Sadzba DPH'),
                Header::make('Prílohy'),
            ])
            ->addable(false)            
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->columnSpan(1)
                    ->default(now()),
                Forms\Components\TextInput::make('code')
                    ->columnSpan(1),
                Forms\Components\TextInput::make('title')
                    ->columnSpan(2),
                
                Forms\Components\TextInput::make('description')
                    ->columnSpan(2),
                Forms\Components\TextInput::make('price')
                    ->columnSpan(1)
                    ->numeric()
                    ->inputMode('decimal'),
                Forms\Components\TextInput::make('vat')
                    ->columnSpan(1)
                    ->numeric()
                    ->inputMode('decimal'),
                SpatieMediaLibraryFileUpload::make('attachmenTask')
                    ->columnSpan(2)
                    ->multiple()
            ]);
    }
}
