<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task;

use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Forms\PlaceOfOriginForm;
use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Task\PlaceOfOriginResource\Tables\PlaceOfOriginTable;
use Dpb\Package\Tasks\Models\PlaceOfOrigin;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlaceOfOriginResource extends Resource
{
    protected static ?string $model = PlaceOfOrigin::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/place-of-origin.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/place-of-origin.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/place-of-origin.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/place-of-origin.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.place-of-origin') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tasks.place-of-origin.read');
    // }
    
    public static function form(Form $form): Form
    {
        return PlaceOfOriginForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return PlaceOfOriginTable::make($table); 
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaceOfOrigins::route('/'),
            'create' => Pages\CreatePlaceOfOrigin::route('/create'),
            'edit' => Pages\EditPlaceOfOrigin::route('/{record}/edit'),
        ];
    }
}
